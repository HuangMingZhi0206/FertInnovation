<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HarvestData extends Model
{
    protected $fillable = [
        'farm_id',
        'crop_type',
        'planting_date',
        'estimated_harvest_date',
        'actual_harvest_date',
        'estimated_yield',
        'actual_yield',
        'yield_unit',
        'production_cost',
        'status',
        'notes',
    ];

    protected $casts = [
        'planting_date' => 'date',
        'estimated_harvest_date' => 'date',
        'actual_harvest_date' => 'date',
        'estimated_yield' => 'float',
        'actual_yield' => 'float',
        'production_cost' => 'float',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
