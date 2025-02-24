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
}
