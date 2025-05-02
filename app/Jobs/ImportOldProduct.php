<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class ImportOldProduct implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = fopen(public_path('products.csv'), 'r');

        $firstLine = true;

        while (($data = fgetcsv($file)) !== false) {
            if (!$firstLine) {


                // product barcode match 
                $product = Product::where('barcode', $data[1])->first();

                if ($product) {
                    continue;
                }

                if ($data[3] != 1 || $data[1] == null) {
                    continue;
                }

                /**
                 * For Brand
                 */
                $brandName = $data[10] ?? null;

                $brand = new Brand();

                if ($brandName) {
                    $brand = Brand::where('name', $brandName)->first();
                    if (!$brand) {

                        // if slug exists then add slug -1
                        $brandSlug = str($brandName)->slug();

                        $brandSlugCount = Brand::where('slug', $brandSlug)->count();
                        if ($brandSlugCount > 0) {
                            $brandSlug = $brandSlug . '-' . $brandSlugCount;
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
                $category_id = null;
                /* $parent_id = null;
                $categories = explode(', ', $data[8]);
                foreach ($categories as $path) {
                    $parts = explode('>', $path);

                    foreach ($parts as $key => $categoryName) {

                        $category = Category::where('name', $categoryName)->first();
                        if (!$category) {

                            // if slug exists then add slug -1
                            $categorySlug = str($categoryName)->slug();

                            $categorySlugCount = Category::where('slug', $categorySlug)->count();
                            if ($categorySlugCount > 0) {
                                $categorySlug = $categorySlug . '-' . $categorySlugCount;
                            }

                            $category = new Category();
                            $category->parent_id = $parent_id ?? null;
                            $category->name = $categoryName;
                            $category->slug = $categorySlug;
                            $category->save();
                        }

                        $parent_id = $category->parent_id;
                    }

                    $category_id = $category->id;
                } */


                if (!$product) {
                    $product = new Product();
                }

                $cleanHtml = str_replace('\n', '', $data[4]);
                $cleanHtml = str_replace('<span class="metadata-label">', '<strong>', $cleanHtml);
                $cleanHtml = str_replace('</span>', '</strong>', $cleanHtml);


                // selling price null than regular price

                log($data[7] . ' - ' . $data[2]);

                $regularPrice = $data[7] ?? 0;
                $sellingPrice = $regularPrice;

                $product->brand_id = $brand->id ?? null;
                $product->category_id = $category_id ?? null;
                $product->name = $data[2];
                $product->slug = str($data[2] . '-' . $data[1])->slug();
                $product->sku = $data[0];
                $product->barcode = $data[1];
                $product->regular_price = $regularPrice;
                $product->selling_price = $sellingPrice ?? 0;
                $product->short_description = str_replace('\n', '', $data[5]);
                $product->long_description = $cleanHtml;

                $product->seo_title = $data[2];

                $product->save();

                // remove images from product
                /* $product->clearMediaCollection('product-images');
                $product->clearMediaCollection('featured-image');

                $images = explode(', ', $data[9]);

                foreach ($images as $key => $image) {
                    if ($key == 0) {
                        continue;
                    }
                    try {
                        $product
                            ->addMediaFromUrl($image)
                            ->preservingOriginal()
                            ->toMediaCollection('product-images');
                    } catch (UnreachableUrl $exception) {
                        log('Unreachable URL: ' . $image);
                        log($data[2]);
                        continue;
                    }
                }

                try {
                    $product
                        ->addMediaFromUrl($images[0])
                        ->preservingOriginal()
                        ->toMediaCollection('featured-image');
                } catch (UnreachableUrl $exception) {
                    log('Unreachable URL: ' . $images[0]);
                    log($data[2]);
                } */
            }

            $firstLine = false;
        }

        fclose($file);
    }
}
