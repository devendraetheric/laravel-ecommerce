<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'blog_posts';

    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'content',
        'published_at',
        'seo_title',
        'seo_description',
        'status',
    ];

    protected $perPage = 10;


    protected $casts = [
        'published_at' => 'date',
    ];



    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function thumbnailURL($size = ''): string|null
    {
        return $this?->getMedia('featured-image')->first()?->getUrl($size) ?? placeholderURL();
    }



    public function blogCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'blog_category_id');
    }
}
