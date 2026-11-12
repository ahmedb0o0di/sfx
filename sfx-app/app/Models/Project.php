<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->thumbnail_image)) {
            return asset('assets/images/placeholder.jpg');
        }

        if (Str::startsWith($this->thumbnail_image, ['http://', 'https://'])) {
            return $this->thumbnail_image;
        }

        if (Str::startsWith($this->thumbnail_image, ['assets/', 'storage/'])) {
            return asset($this->thumbnail_image);
        }

        return asset('storage/' . $this->thumbnail_image);
    }

    /**
     * Get unique gallery image URLs including the hero/thumbnail image.
     * Guaranteed to return a plain PHP array of string URLs.
     *
     * @return array<int, string>
     */
    public function getGalleryUrlsAttribute(): array
    {
        $gallery = [];

        $mainImg = $this->image_url;
        if (!empty($mainImg)) {
            $gallery[] = $mainImg;
        }

        if ($this->relationLoaded('images')) {
            foreach ($this->images as $img) {
                if (!empty($img->image_url)) {
                    $gallery[] = $img->image_url;
                }
            }
        } elseif ($this->images()->exists()) {
            foreach ($this->images as $img) {
                if (!empty($img->image_url)) {
                    $gallery[] = $img->image_url;
                }
            }
        }

        return array_values(array_unique(array_filter($gallery)));
    }
}
