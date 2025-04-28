<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
