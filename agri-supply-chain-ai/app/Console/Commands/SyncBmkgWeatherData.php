<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BmkgWeatherService;
use App\Models\WeatherData;
use App\Models\Farm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SyncBmkgWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:sync-bmkg {--farm_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync weather data from BMKG API to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting BMKG weather data sync...');

        $bmkgService = new BmkgWeatherService();
        
        // Get farms to sync weather data for
        $farmId = $this->option('farm_id');
        $farms = $farmId ? Farm::where('id', $farmId)->get() : Farm::all();

        if ($farms->isEmpty()) {
            $this->warn('No farms found to sync weather data.');
            return 0;
        }

        $this->info("Found {$farms->count()} farm(s) to sync.");

        $syncedCount = 0;
        $errorCount = 0;

        foreach ($farms as $farm) {
            try {
                $this->info("Syncing weather for farm: {$farm->name} (ID: {$farm->id})");
                
                // Fetch BMKG forecast data
                $bmkgData = $bmkgService->fetchForecast();
                $forecasts = $bmkgData['forecasts'];

                if (empty($forecasts)) {
                    $this->warn("No forecast data received from BMKG for farm {$farm->id}");
                    $errorCount++;
                    continue;
                }

                $this->info("Received " . count($forecasts) . " forecast entries");

                // Process each forecast entry
                foreach ($forecasts as $forecast) {
                    try {
                        // Parse the local datetime
                        $date = Carbon::parse($forecast['local_datetime']);
                        
                        // Only sync future or today's data (not past data)
                        if ($date->isFuture() || $date->isToday()) {
                            // Check if weather data already exists for this farm and date
                            $existing = WeatherData::where('farm_id', $farm->id)
                                ->where('date', $date->format('Y-m-d'))
                                ->first();

                            $weatherData = [
                                'farm_id' => $farm->id,
                                'date' => $date->format('Y-m-d'),
                                'temperature_max' => $forecast['t'] ?? null,
                                'temperature_min' => $forecast['t'] ?? null, // BMKG gives single temp, using same for both
                                'humidity' => $forecast['hu'] ?? null,
                                'rainfall' => $forecast['tp'] ?? 0,
                                'weather_condition' => $forecast['weather_desc'] ?? 'Unknown',
                                'wind_speed' => $forecast['ws'] ?? null,
                                'updated_at' => now(),
                            ];

                            if ($existing) {
                                $existing->update($weatherData);
                                $this->line("  Updated: {$date->format('Y-m-d H:i')} - {$forecast['weather_desc']}");
                            } else {
                                $weatherData['created_at'] = now();
                                WeatherData::create($weatherData);
                                $this->line("  Created: {$date->format('Y-m-d H:i')} - {$forecast['weather_desc']}");
                            }
                            
                            $syncedCount++;
                        }
                    } catch (\Exception $e) {
                        $this->error("  Error processing forecast entry: " . $e->getMessage());
                        $errorCount++;
                    }
                }

                $this->info("✓ Completed sync for farm: {$farm->name}");
                
            } catch (\Exception $e) {
                $this->error("✗ Error syncing farm {$farm->id}: " . $e->getMessage());
                Log::error("BMKG sync error for farm {$farm->id}: " . $e->getMessage());
                $errorCount++;
            }
        }

        $this->newLine();
        $this->info("Sync completed!");
        $this->info("Successfully synced: {$syncedCount} weather records");
        
        if ($errorCount > 0) {
            $this->warn("Errors encountered: {$errorCount}");
        }

        return 0;
    }
}
