<?php

namespace Database\Factories;

use App\Models\Brand;
use Database\Seeders\LocalImages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->company(),
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(),
            'seo_title' => $this->faker->realText(60),
            'seo_description' => $this->faker->realText(160),
            // Timestamps
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }

    public function configure(): BrandFactory
    {
        return $this->afterCreating(function (Brand $brand) {
            try {
                $brand
                    ->addMedia(LocalImages::getRandomFile())
                    ->preservingOriginal()
                    ->toMediaCollection();
            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
