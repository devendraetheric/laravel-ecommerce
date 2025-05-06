<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
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

                    $media = $product->getMedia('featured-image');
                    if ($media->count() > 0) {
                        continue;
                    }

                    // remove images from product
                    $product->clearMediaCollection('product-images');
                    $product->clearMediaCollection('featured-image');

                    $images = explode(', ', $data[9]);

                    $images = array_filter($images, function ($image) {
                        return $image != '';
                    });

                    Log::info($images);
                    if ($images) {
                        foreach ($images as $key => $image) {
                            if ($key == 0) {
                                continue;
                            }
                            try {
                                $product
                                    ->addMedia(public_path($image))
                                    ->preservingOriginal()
                                    ->toMediaCollection('product-images');
                            } catch (UnreachableUrl $exception) {
                                Log::info('Unreachable URL: ' . $image);
                                Log::info($data[2]);
                                continue;
                            }
                        }

                        try {
                            $product
                                ->addMedia(public_path($image))
                                ->preservingOriginal()
                                ->toMediaCollection('featured-image');
                        } catch (UnreachableUrl $exception) {
                            Log::info('Unreachable URL: ' . $images[0]);
                            Log::info($data[2]);
                        }

                        Log::info("update product: " . $product->barcode);
                    }
                }
            }

            $firstLine = false;
        }

        fclose($file);
    }
}
