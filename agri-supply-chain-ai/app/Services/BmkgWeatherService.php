<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BmkgWeatherService
{
    protected $http;

    public function __construct(?Client $client = null)
    {
        $this->http = $client ?: new Client([
            'base_uri' => 'https://api.bmkg.go.id/',
            'timeout' => 10,
            'verify' => false, // Disable SSL verification for development
            // For production, use: 'verify' => storage_path('cacert.pem')
        ]);
    }

    /**
     * Fetch and cache BMKG forecast data for a given ADM4 code.
     *
     * @param string|null $adm4Code
     * @return array{code:string,forecasts:array}
     */
    public function fetchForecast(?string $adm4Code = null): array
    {
        $code = $adm4Code ?: env('BMKG_ADM4_CODE', '31.71.03.1001');
        $cacheMinutes = (int) env('BMKG_CACHE_MINUTES', 30);
        $cacheKey = 'bmkg_forecast_' . $code;

        return Cache::remember($cacheKey, now()->addMinutes($cacheMinutes), function () use ($code) {
            try {
                $response = $this->http->get('publik/prakiraan-cuaca', [
                    'query' => ['adm4' => $code],
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                ]);
                $data = json_decode($response->getBody()->getContents(), true);
                
                // Debug log
                Log::info('BMKG Raw Response', [
                    'adm4' => $code,
                    'has_data' => isset($data['data']),
                    'data_count' => isset($data['data']) ? count($data['data']) : 0,
                    'response_keys' => array_keys($data ?? []),
                ]);
                
                // Normalize: ensure we return only array of forecast rows under 'data'
                $forecasts = [];
                if (is_array($data)) {
                    // BMKG response may wrap items; attempt to locate array with weather keys
                    $flatten = $this->extractForecastRows($data);
                    $forecasts = $flatten;
                }
                return [
                    'code' => $code,
                    'forecasts' => $forecasts,
                ];
            } catch (\Throwable $e) {
                Log::warning('BMKG forecast error: ' . $e->getMessage());
                return [
                    'code' => $code,
                    'forecasts' => [],
                ];
            }
        });
    }

    /**
     * Attempt to extract forecast rows from BMKG JSON structure.
     * BMKG structure: data[0].cuaca[[array of forecasts], [array of forecasts], ...]
     *
     * @param array $data
     * @return array
     */
    protected function extractForecastRows(array $data): array
    {
        $results = [];
        
        // BMKG structure: check if we have data array
        if (isset($data['data']) && is_array($data['data'])) {
            foreach ($data['data'] as $dataItem) {
                // Check for cuaca array
                if (isset($dataItem['cuaca']) && is_array($dataItem['cuaca'])) {
                    // cuaca is array of arrays of forecast objects
                    foreach ($dataItem['cuaca'] as $cuacaGroup) {
                        if (is_array($cuacaGroup)) {
                            foreach ($cuacaGroup as $forecast) {
                                if (is_array($forecast) && isset($forecast['local_datetime']) && isset($forecast['t'])) {
                                    $results[] = $forecast;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        // Fallback: try recursive search if no results found
        if (empty($results)) {
            $results = $this->recursiveExtractForecastRows($data);
        }
        
        // Deduplicate by local_datetime
        $unique = [];
        $seen = [];
        foreach ($results as $r) {
            $dt = $r['local_datetime'] ?? uniqid('f');
            if (!isset($seen[$dt])) {
                $seen[$dt] = true;
                $unique[] = $r;
            }
        }
        
        // Sort by local_datetime ascending
        usort($unique, function ($a, $b) {
            return strcmp($a['local_datetime'] ?? '', $b['local_datetime'] ?? '');
        });
        
        return $unique;
    }

    /**
     * Recursive fallback method to extract forecasts
     */
    protected function recursiveExtractForecastRows(array $data): array
    {
        $results = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator($data), 
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $key => $value) {
            if (is_array($value)) {
                if ($this->looksLikeForecastList($value)) {
                    foreach ($value as $row) {
                        if (is_array($row) && isset($row['local_datetime']) && isset($row['t'])) {
                            $results[] = $row;
                        }
                    }
                }
            }
        }
        
        return $results;
    }

    protected function looksLikeForecastList(array $candidate): bool
    {
        // Heuristic: array with >=3 elements where first contains keys like 't' or 'weather_desc'
        $sample = null;
        foreach ($candidate as $c) { if (is_array($c)) { $sample = $c; break; } }
        if (!$sample) { return false; }
        $keys = array_keys($sample);
        return (in_array('t', $keys) || in_array('weather_desc', $keys)) && in_array('local_datetime', $keys);
    }
}
