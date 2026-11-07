<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FertilizerUsage extends Model
{
    protected $fillable = [
        'farm_id',
        'date',
        'fertilizer_type',
        'quantity',
        'unit',
        'fertilizer_cost',
        'application_method',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'quantity' => 'float',
        'fertilizer_cost' => 'float',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
