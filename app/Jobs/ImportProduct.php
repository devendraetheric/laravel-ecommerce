<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

use function Illuminate\Log\log;

class ImportProduct implements ShouldQueue
{
    use Queueable;

    public $tries = 25;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('import-product');
    }

    public function backoff()
    {
        return [30 * 60]; // 30 minutes in seconds
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = fopen(public_path('product-list.csv'), 'r');

        $firstLine = true;

        while (($data = fgetcsv($file)) !== false) {
            if (!$firstLine) {

                // CrawlUrlJob::dispatch($data)
                //     ->onQueue('import-product');

                // check product exists or not
                $product = Product::where('barcode', $data[1])->first();
                if ($product) {
                    log('Product Already Exists: ' . $product->slug);
                    continue;
                }

                $product = $this->saveProduct($data);
                if ($product) {
                    log('Product Imported: ' . $product->name);
                } else {
                    log('Product Import Failed: ' . $data[0]);
                }

                sleep(120);
            }

            $firstLine = false;
        }

        fclose($file);
    }

    public function saveProduct($data): Product
    {
        $barcode = $data[1];
        $sku = $data[0];
        $price = $data[2];

        $url = "https://go-upc.com/search?q={$barcode}";

        // Fetch the HTML content
        $response = Http::get($url);


        $html = $response->body();

        // Use DomCrawler to parse HTML
        $crawler = new Crawler($html);

        // Extract product name (example selector, adjust based on actual HTML)
        $productName = $crawler->filter('h1')->first()->text();

        // Extract EAN, UPC, Brand, Category, Description, etc.
        // For example, extract table rows with EAN, UPC, Brand:
        $details = [];
        // get table with class is table and tbody
        $crawler->filter('table tr')->each(function (Crawler $row) use (&$details) {
            $tds = $row->filter('td');
            // Check if there are at least 2 <td> elements
            if ($tds->count() >= 2) {
                $key = trim($tds->eq(0)->text());
                $value = trim($tds->eq(1)->text());
                $details[$key] = $value;
            }
        });

        // Extract Description (example selector)
        $description = $crawler->filter('h2:contains("Description") + span')->count() ?
            $crawler->filter('h2:contains("Description") + span')->text() : null;

        $ingredients = $crawler->filter('h2:contains("Ingredients") + span')->count() ?
            $crawler->filter('h2:contains("Ingredients") + span')->text() : null;

        $additionalAttributesArr = $crawler->filter('h2:contains("Additional Attributes") + ul li')->each(function ($node) {
            return $node->text();
        });

        // get image figure class is product-image and element is img
        $image = $crawler->filter('figure.product-image img')->first()->attr('src');

        // $additionalAttributes is in , seperated with each and after that separated with :
        // so we need to split it into array
        // $additionalAttributesArr = explode(',', $additionalAttributes);
        // now convert into ul and li
        $additionalAttributesStr = '<ul>';
        foreach ($additionalAttributesArr as $key => $value) {
            $value = explode(':', $value);
            if (count($value) == 2) {
                $additionalAttributesStr .= '<li><strong>' . trim($value[0]) . '</strong> : ' . trim($value[1]) . '</li>';
            }
        }
        $additionalAttributesStr .= '</ul>';

        // dd($productName, $details, $description, $ingredients, $additionalAttributesArr, $additionalAttributesStr, $image);

        $ingredients = $ingredients ? '<h2>Ingredients</h2><p>' . $ingredients . '</p>' : '';
        $additionalAttributesStr = $additionalAttributesStr ? '<h2>Product Specification</h2>' . $additionalAttributesStr : '';

        // Save to database

        $product = Product::where('barcode', $barcode)->first();

        if (!$product) {
            $product = new Product();
        }

        /**
         * For Brand
         */
        $brandName = $details['Brand'] ?? null;

        $brand = new Brand();

        if ($brandName) {
            $brand = Brand::where('name', $brandName)->first();
            if (!$brand) {

                // if slug exists then add slug -1
                $brandSlug = str($brandName)->slug();

                $brandSlugCount = Brand::where('slug', $brandSlug)->count();
                if ($brandSlugCount > 0) {
                    $brandSlug = $brandSlug . '-' . ($brandSlugCount + 1);
                }

                $brand = new Brand();
                $brand->name = $brandName;
                $brand->slug = $brandSlug;
                $brand->save();
            }
        }
        /**
         * For Category
         */

        $categoryName = $details['Category'] ?? null;

        $category = new Category();

        if ($categoryName) {
            $category = Category::where('name', $categoryName)->first();
            if (!$category) {

                // if slug exists then add slug -1
                $categorySlug = str($categoryName)->slug();

                $categorySlugCount = Category::where('slug', $categorySlug)->count();
                if ($categorySlugCount > 0) {
                    $categorySlug = $categorySlug . '-' . ($categorySlugCount + 1);
                }

                $category = new Category();
                $category->name = $categoryName;
                $category->slug = $categorySlug;
                $category->save();
            }
        }

        $slug = str($productName . '-' . $barcode)->slug();

        $product->brand_id = $brand?->id;
        $product->category_id = $category?->id;
        $product->name = $productName;
        $product->slug = $slug;
        $product->barcode = $barcode;
        $product->sku = $sku;
        $product->regular_price = $price;
        $product->selling_price = $price;
        $product->short_description = $description;
        $product->long_description = $ingredients . $additionalAttributesStr;
        $product->seo_title = $productName;
        $product->save();

        // remove images from product
        $product->clearMediaCollection('product-images');
        $product->clearMediaCollection('featured-image');

        $product->addMediaFromUrl($image)
            ->preservingOriginal()
            ->toMediaCollection('featured-image');

        return $product;
    }
}
