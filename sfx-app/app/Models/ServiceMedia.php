<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ServiceMedia extends Model
{
    use HasFactory;

    protected $table = 'service_media';

    protected $guarded = [];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function getMediaUrlAttribute(): string
    {
        if (!empty($this->external_url)) {
            return $this->external_url;
        }

        if (empty($this->file_path)) {
            return asset('assets/images/solutions/architectural.png');
        }

        if (Str::startsWith($this->file_path, ['http://', 'https://'])) {
            return $this->file_path;
        }

        if (Str::startsWith($this->file_path, ['assets/', 'storage/'])) {
            return asset($this->file_path);
        }

        return asset('storage/' . $this->file_path);
    }

    public function getIsVideoAttribute(): bool
    {
        if ($this->media_type === 'video') {
            return true;
        }

        $path = strtolower($this->file_path ?? '');
        if (Str::endsWith($path, ['.mp4', '.webm', '.ogg', '.mov'])) {
            return true;
        }

        $url = strtolower($this->external_url ?? '');
        if (Str::contains($url, ['youtube.com', 'youtu.be', 'vimeo.com']) || Str::endsWith($url, ['.mp4', '.webm'])) {
            return true;
        }

        return false;
    }

    public function getEmbedUrlAttribute(): ?string
    {
        $url = $this->external_url;
        if (empty($url)) {
            return null;
        }

        // YouTube Embed format
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/i', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&rel=0';
        }

        // Vimeo Embed format
        if (preg_match('/vimeo\.com\/(?:video\/)?([0-9]+)/i', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1] . '?autoplay=1';
        }

        return $url;
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!$this->is_video) {
            return $this->media_url;
        }

        // If it's a YouTube video, use high-res YouTube poster
        if (!empty($this->external_url) && preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/i', $this->external_url, $matches)) {
            return 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
        }

        // Return parent service hero image as fallback video poster thumbnail
        return $this->service?->image_url ?? asset('assets/images/solutions/architectural.png');
    }
}
