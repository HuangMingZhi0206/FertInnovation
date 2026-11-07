<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WaterUsage extends Model
{
    protected $fillable = [
        'farm_id',
        'date',
        'water_amount',
        'water_source',
        'irrigation_method',
        'water_cost',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'water_amount' => 'float',
        'water_cost' => 'float',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
