<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getImageUrlAttribute(): string
    {
        if (empty($this->featured_image)) {
            return asset('assets/images/placeholder.jpg');
        }

        if (Str::startsWith($this->featured_image, ['http://', 'https://'])) {
            return $this->featured_image;
        }

        if (Str::startsWith($this->featured_image, ['assets/', 'storage/'])) {
            return asset($this->featured_image);
        }

        return asset('storage/' . $this->featured_image);
    }

    public function getVideoUrlAttribute(): ?string
    {
        if (empty($this->video_path)) {
            return null;
        }

        if (Str::startsWith($this->video_path, ['http://', 'https://'])) {
            return $this->video_path;
        }

        if (Str::startsWith($this->video_path, ['assets/', 'storage/'])) {
            return asset($this->video_path);
        }

        return asset('storage/' . $this->video_path);
    }
}
