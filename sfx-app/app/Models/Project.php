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
}
