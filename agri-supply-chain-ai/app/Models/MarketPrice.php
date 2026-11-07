<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketPrice extends Model
{
    protected $fillable = [
        'product_name',
        'market_location',
        'price_per_unit',
        'unit',
        'date',
        'demand_level',
        'trend',
    ];

    protected $casts = [
        'date' => 'date',
        'price_per_unit' => 'float',
        'demand_level' => 'integer',
    ];
}
