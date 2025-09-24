<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'first_name'    => 'Test',
            'last_name'     => 'User',
            'email'         => 'test@example.com',
            'phone'         => '9876543210',
            'password'      => Hash::make('123456'),
        ]);


        // Delete media folders and files
        \File::deleteDirectory(public_path('media'));

        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(BannerSeeder::class);

        // Brand::factory(8)->create();
        // Category::factory(4)->create();

        // Product::factory(60)->create();
    }
}
