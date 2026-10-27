<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatorLead extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'footprint_area' => 'decimal:2',
        'calculated_tonnage' => 'decimal:2',
    ];
}
