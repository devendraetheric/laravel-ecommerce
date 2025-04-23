<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Database\Seeders\LocalImages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->catchPhrase(),
            'slug' => Str::slug($name),
            'short_description' => $this->faker->paragraph(),
            'long_description' => $this->faker->paragraph(20),
            'regular_price' => $this->faker->randomFloat(2, 10, 1000),
            'selling_price' => $this->faker->randomFloat(2, 10, 1000),
            'sku' => $this->faker->unique()->numerify('##########'),
            'barcode' => $this->faker->unique()->ean13(),
            'is_featured' => $this->faker->boolean(15),
            'category_id' => Category::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'seo_title' => $this->faker->realText(60),
            'seo_description' => $this->faker->realText(160),
            // Timestamps
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }

    public function configure(): ProductFactory
    {
        return $this->afterCreating(function (Product $product) {
            try {
                $product
                    ->addMedia(LocalImages::getRandomFile())
                    ->preservingOriginal()
                    ->toMediaCollection('featured-image');
            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
