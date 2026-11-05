<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'technical_specs' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->hero_image)) {
            return asset('assets/images/solutions/architectural.png');
        }

        if (Str::startsWith($this->hero_image, ['http://', 'https://'])) {
            return $this->hero_image;
        }

        if (Str::startsWith($this->hero_image, ['assets/', 'storage/'])) {
            return asset($this->hero_image);
        }

        return asset('storage/' . $this->hero_image);
    }

    public function getBadgeTextAttribute(): string
    {
        if (!empty($this->badge)) {
            return $this->badge;
        }

        return match ($this->slug) {
            'architectural-tensile' => 'ETFE & PTFE',
            'sports-canopies' => 'Stadia & Arenas',
            'commercial-atriums' => 'Malls & Atriums',
            'transport-infrastructure' => 'Transit Hubs',
            'industrial-logistics' => 'Bulk Logistics',
            'air-supported-domes' => 'ASATI UAE Partner',
            'lifecycle-maintenance' => 'Asset Stewardship',
            default => Str::limit($this->subtitle ?? 'Specialized System', 22),
        };
    }
}
