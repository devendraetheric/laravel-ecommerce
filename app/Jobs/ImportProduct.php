<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportProduct implements ShouldQueue
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

                if ($data[3] != 1) {
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
                            $brandSlug = $brandSlug . '-' . ($brandSlugCount + 1);
                        }

                        $brand = new Brand();
                        $brand->name = $brandName;
                        $brand->slug = $brandSlug;
                        $brand->save();
                    }
                }

                // product barcode match 
                $product = Product::where('barcode', $data[1])->first();

                if (!$product) {
                    $product = new Product();
                }

                $cleanHtml = str_replace('\n', '', $data[4]);
                $cleanHtml = str_replace('<span class="metadata-label">', '<strong>', $cleanHtml);
                $cleanHtml = str_replace('</span>', '</strong>', $cleanHtml);


                // selling price null than regular price
                $sellingPrice = $data[6];
                if (!$sellingPrice) {
                    $sellingPrice = $data[7];
                }

                $product->brand_id = $brand->id ?? null;
                $product->name = $data[2];
                $product->slug = str($data[2] . '-' . $data[1])->slug();
                $product->sku = $data[0];
                $product->barcode = $data[1];
                $product->regular_price = $data[7];
                $product->selling_price = $sellingPrice ?? 0;
                $product->short_description = $data[5];
                $product->long_description = $cleanHtml;

                $product->seo_title = $data[2];

                $product->save();

                // remove images from product
                $product->clearMediaCollection('product-images');
                $product->clearMediaCollection('featured-image');

                $images = explode(', ', $data[9]);

                foreach ($images as $key => $image) {
                    if ($key == 0) {
                        continue;
                    }
                    $product
                        ->addMediaFromUrl($image)
                        ->preservingOriginal()
                        ->toMediaCollection('product-images');
                }

                $product
                    ->addMediaFromUrl($images[0])
                    ->preservingOriginal()
                    ->toMediaCollection('featured-image');
            }

            $firstLine = false;
        }

        fclose($file);
    }
}
