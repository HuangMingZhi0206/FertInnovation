<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'location',
        'area',
        'crop_type',
        'soil_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function weatherData(): HasMany
    {
        return $this->hasMany(WeatherData::class);
    }

    public function harvestData(): HasMany
    {
        return $this->hasMany(HarvestData::class);
    }

    public function waterUsage(): HasMany
    {
        return $this->hasMany(WaterUsage::class);
    }

    public function fertilizerUsage(): HasMany
    {
        return $this->hasMany(FertilizerUsage::class);
    }
}
