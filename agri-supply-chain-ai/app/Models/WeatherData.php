<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherData extends Model
{
    protected $fillable = [
        'farm_id',
        'date',
        'temperature_max',
        'temperature_min',
        'humidity',
        'rainfall',
        'wind_speed',
        'weather_condition',
    ];

    protected $casts = [
        'date' => 'date',
        'temperature_max' => 'float',
        'temperature_min' => 'float',
        'humidity' => 'float',
        'rainfall' => 'float',
        'wind_speed' => 'float',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
