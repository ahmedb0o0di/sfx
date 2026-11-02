<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CareerApplication extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'interview_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The career position this application belongs to (if specific).
     */
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    /**
     * Get the full downloadable URL of the CV / resume.
     */
    public function getCvUrlAttribute(): ?string
    {
        if (empty($this->cv_path)) {
            return null;
        }

        return Storage::disk('public')->url($this->cv_path);
    }

    /**
     * Get clean filename of the CV.
     */
    public function getCvFilenameAttribute(): ?string
    {
        if (empty($this->cv_path)) {
            return null;
        }

        return basename($this->cv_path);
    }

    /**
     * Get resolved job title.
     */
    public function getJobDisplayTitleAttribute(): string
    {
        return $this->career?->title ?? $this->job_title ?? 'General Practice Application';
    }
}
