<?php

namespace App\Models;

use App\Gender;
use App\HasHashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Child extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, HasHashId;

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'condition',
        'caregiver',
    ];

    protected $casts = [
        'caregiver' => 'array',
    ];

    protected $appends = [
        'child_image_url',
        'child_image_conversions_url'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('child_image')
            ->singleFile()
            ->useFallbackUrl($this->getFallbackUrl($this->gender));
    }

    public function getFallbackUrl($gender): string
    {
        return asset(match ($gender) {
            Gender::Male->value, Gender::Female->value => 'images/pfp.jpg',
            default => 'images/placeholder.png'
        });
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

    public function getChildImageUrlAttribute()
    {
        $media = $this->getFirstMedia('child_image');

        return $media ? $media->getUrl() : $this->getFallbackUrl($this->gender);
    }

    public function getChildImageConversionsUrlAttribute()
    {
        $media = $this->getFirstMedia('child_image');

        if (!$media) {
            return $this->getFallbackUrl($this->gender);
        }

        $conversions = ['large', 'medium', 'thumb'];
        $srcset = [];

        foreach ($conversions as $conversion) {
            $url = $media->getUrl($conversion);

            if ($url) {
                // Use predefined conversion sizes
                $width = $conversion === 'large' ? 1200 :
                    ($conversion === 'medium' ? 800 : 200);

                $srcset[] = "{$url} {$width}w";
            }
        }

        return implode(', ', $srcset);
    }

    public function getCaregiverAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_null($value) || $value === '') {
            return [];
        }
        // If it's a JSON string, decode it
        if (is_string($value) && (str_starts_with($value, '[') || str_starts_with($value, '{'))) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [$value];
        }
        // Otherwise, return as single-item array
        return [$value];
    }

// Add an accessor to handle display
    public function getCaregiverDisplayAttribute()
    {
        return is_array($this->caregiver) ? implode(', ', $this->caregiver) : $this->caregiver;
    }
}
