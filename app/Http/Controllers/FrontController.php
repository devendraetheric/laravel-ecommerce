<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class FrontController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::featured()->take(8)->get();
        $latestProducts = Product::latest()->take(8)->get();
        $bestSellingProducts = Product::active()->take(8)->get();

        $topCategories = Category::withCount('products')
            ->latest()
            ->take(8)
            ->get();

        $brands = Brand::withCount('products')
            ->latest()
            ->take(12)
            ->get();

        return view('front.home', compact('featuredProducts', 'latestProducts', 'bestSellingProducts', 'topCategories', 'brands'));
    }

    // Import From csv
    public function import()
    {
        ini_set('max_execution_time', '0');

        $file = fopen(public_path('products.csv'), 'r');

        $firstLine = true;

        while (($data = fgetcsv($file)) !== false) {
            if (!$firstLine) {

                if ($data[3] != 1) {
                    continue;
                }

                // product barcode match 
                $product = new Product();

                $cleanHtml = strip_tags($data[4]);
                $cleanHtml = str_replace(["\n", "\r", "\t"], '', $cleanHtml);
                $cleanHtml = trim(preg_replace('/\s+/', ' ', $cleanHtml));

                // selling price null than regular price
                $sellingPrice = $data[6];
                if (!$sellingPrice) {
                    $sellingPrice = $data[7];
                }

                $product->name = $data[2];
                $product->slug = str($data[2] . '-' . $data[1])->slug();
                $product->sku = $data[0];
                $product->barcode = $data[1];
                $product->regular_price = $data[7];
                $product->selling_price = $sellingPrice;
                $product->short_description = $data[4];
                $product->long_description = $data[5];

                $product->save();

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

        return 'Products imported successfully!';
    }
}
