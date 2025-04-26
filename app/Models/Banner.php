<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Banner extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'image',
        'link',
        'is_new_tab',
        'is_active',
        'location',
        'click_count',
        'view_count',
    ];

    protected $casts = [
        'is_new_tab' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $perPage = 10;

    public function thumbnailURL($size = ''): string|null
    {
        return $this?->getMedia()->first()?->getUrl($size) ?? asset('/placeholder.png');
    }


}
