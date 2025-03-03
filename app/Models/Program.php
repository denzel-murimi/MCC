<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Program extends Model implements HasMedia
{
    use InteractsWithMedia, HasSlug, HasFactory;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useFallbackUrl(asset('images/placeholder.jpg'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
        ->width(200)
        ->height(200)
        ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600);

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(900);
    }

    protected $fillable = [
        'author',
        'title',
        'description',
        'content',
        'event_id',
        'slug'
    ];

    protected $appends = ['featured_image_url'];

    public function getFeaturedImageUrlAttribute()
    {
        $media = $this->getFirstMedia('featured_image');

        return $media ? $media->getUrl() : asset('images/placeholder.jpg');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function event():  BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)->with('event')->firstOrFail() ?? abort(404);
    }
}
