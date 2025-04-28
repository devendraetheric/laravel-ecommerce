<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banner1 = Banner::create([
            'name' => 'Default Banner 1',
            'location' => 'slider',
        ]);
        $banner1->addMedia(public_path('assets/images/Banner 1.jpg'))
            ->preservingOriginal()
            ->toMediaCollection($banner1->location);

        $banner2 = Banner::create([
            'name' => 'Default Banner 2',
            'location' => 'slider',
            'link' => config('app.url'),
            'is_new_tab' => true,
        ]);
        $banner2->addMedia(public_path('assets/images/Banner 2.jpg'))
            ->preservingOriginal()
            ->toMediaCollection($banner2->location);
    }
}
