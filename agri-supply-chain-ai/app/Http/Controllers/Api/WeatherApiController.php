<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BmkgWeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeatherApiController extends Controller
{
    /**
     * Get weather data based on GPS coordinates
     */
    public function getWeatherByLocation(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'lon' => 'required|numeric|between:-180,180',
        ]);

        $lat = $request->input('lat');
        $lon = $request->input('lon');

        try {
            // Indonesia coordinates validation (approximate bounds)
            if ($lat < -11 || $lat > 6 || $lon < 95 || $lon > 141) {
                return response()->json([
                    'success' => false,
                    'message' => 'Koordinat berada di luar wilayah Indonesia',
                ], 400);
            }

            // Find nearest ADM4 code based on coordinates
            $adm4Code = $this->findNearestAdm4Code($lat, $lon);

            // Fetch weather data from BMKG
            $bmkgService = new BmkgWeatherService();
            $weatherData = $bmkgService->fetchForecast($adm4Code);

            Log::info('BMKG Weather Data', [
                'adm4' => $adm4Code,
                'lat' => $lat,
                'lon' => $lon,
                'forecast_count' => count($weatherData['forecasts'] ?? [])
            ]);

            if (empty($weatherData['forecasts'])) {
                // Try default Jakarta location as fallback
                $defaultAdm4 = '31.71.03.1001';
                $weatherData = $bmkgService->fetchForecast($defaultAdm4);
                
                if (empty($weatherData['forecasts'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data cuaca tidak tersedia untuk lokasi ini. BMKG API mungkin sedang tidak tersedia.',
                        'location' => [
                            'lat' => $lat,
                            'lon' => $lon,
                            'adm4' => $adm4Code,
                        ],
                    ], 503); // Service Unavailable instead of 404
                }
                
                // Use fallback location info
                $locationInfo = $this->getLocationInfo($defaultAdm4);
                $locationInfo['note'] = 'Menggunakan data Jakarta (default) karena data lokasi Anda tidak tersedia';
            } else {
                // Get location info from found ADM4
                $locationInfo = $this->getLocationInfo($adm4Code);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data cuaca berhasil diambil',
                'location' => $locationInfo,
                'coordinates' => [
                    'lat' => $lat,
                    'lon' => $lon,
                ],
                'adm4_code' => $adm4Code,
                'forecast_count' => count($weatherData['forecasts']),
                'forecasts' => array_slice($weatherData['forecasts'], 0, 10),
                'next_forecast' => $weatherData['forecasts'][0] ?? null,
            ]);

        } catch (\Exception $e) {
            Log::error('Weather API error: ' . $e->getMessage(), [
                'lat' => $lat,
                'lon' => $lon,
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data cuaca',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
            ], 500);
        }
    }

    /**
     * Find nearest ADM4 code based on coordinates
     * This is a simplified version - in production, use a proper spatial database
     */
    private function findNearestAdm4Code($lat, $lon)
    {
        // Simple mapping for major cities
        // In production, this should query a database with all ADM4 codes and their coordinates
        $locations = [
            // Jakarta area
            ['lat' => -6.1753, 'lon' => 106.8271, 'adm4' => '31.71.03.1001', 'name' => 'Jakarta Pusat'],
            ['lat' => -6.2088, 'lon' => 106.8456, 'adm4' => '31.72.05.1001', 'name' => 'Jakarta Selatan'],
            ['lat' => -6.1256, 'lon' => 106.8784, 'adm4' => '31.73.03.1001', 'name' => 'Jakarta Timur'],
            ['lat' => -6.1384, 'lon' => 106.7511, 'adm4' => '31.74.04.1001', 'name' => 'Jakarta Barat'],
            ['lat' => -6.1389, 'lon' => 106.8931, 'adm4' => '31.75.06.1001', 'name' => 'Jakarta Utara'],
            
            // Bandung
            ['lat' => -6.9175, 'lon' => 107.6191, 'adm4' => '32.73.06.1001', 'name' => 'Bandung'],
            
            // Surabaya
            ['lat' => -7.2504, 'lon' => 112.7688, 'adm4' => '35.78.14.1001', 'name' => 'Surabaya'],
            
            // Yogyakarta
            ['lat' => -7.7956, 'lon' => 110.3695, 'adm4' => '34.71.04.1001', 'name' => 'Yogyakarta'],
            
            // Semarang
            ['lat' => -6.9667, 'lon' => 110.4167, 'adm4' => '33.74.07.1001', 'name' => 'Semarang'],
            
            // Medan
            ['lat' => 3.5952, 'lon' => 98.6722, 'adm4' => '12.71.10.1001', 'name' => 'Medan'],
        ];

        $nearestDistance = PHP_FLOAT_MAX;
        $nearestAdm4 = '31.71.03.1001'; // Default to Jakarta Pusat

        foreach ($locations as $location) {
            // Calculate distance using Haversine formula (simplified)
            $distance = sqrt(
                pow($lat - $location['lat'], 2) + 
                pow($lon - $location['lon'], 2)
            );

            if ($distance < $nearestDistance) {
                $nearestDistance = $distance;
                $nearestAdm4 = $location['adm4'];
            }
        }

        return $nearestAdm4;
    }

    /**
     * Get location information for an ADM4 code
     */
    private function getLocationInfo($adm4Code)
    {
        // Mapping of ADM4 codes to location info
        $locationMap = [
            '31.71.03.1001' => ['provinsi' => 'DKI Jakarta', 'kotkab' => 'Jakarta Pusat', 'kecamatan' => 'Kemayoran', 'desa' => 'Kemayoran'],
            '31.72.05.1001' => ['provinsi' => 'DKI Jakarta', 'kotkab' => 'Jakarta Selatan', 'kecamatan' => 'Kebayoran Baru', 'desa' => 'Kebayoran Baru'],
            '31.73.03.1001' => ['provinsi' => 'DKI Jakarta', 'kotkab' => 'Jakarta Timur', 'kecamatan' => 'Matraman', 'desa' => 'Matraman'],
            '31.74.04.1001' => ['provinsi' => 'DKI Jakarta', 'kotkab' => 'Jakarta Barat', 'kecamatan' => 'Kebon Jeruk', 'desa' => 'Kebon Jeruk'],
            '31.75.06.1001' => ['provinsi' => 'DKI Jakarta', 'kotkab' => 'Jakarta Utara', 'kecamatan' => 'Tanjung Priok', 'desa' => 'Tanjung Priok'],
            '32.73.06.1001' => ['provinsi' => 'Jawa Barat', 'kotkab' => 'Bandung', 'kecamatan' => 'Bandung Wetan', 'desa' => 'Citarum'],
            '35.78.14.1001' => ['provinsi' => 'Jawa Timur', 'kotkab' => 'Surabaya', 'kecamatan' => 'Genteng', 'desa' => 'Genteng'],
            '34.71.04.1001' => ['provinsi' => 'DI Yogyakarta', 'kotkab' => 'Yogyakarta', 'kecamatan' => 'Gondokusuman', 'desa' => 'Terban'],
            '33.74.07.1001' => ['provinsi' => 'Jawa Tengah', 'kotkab' => 'Semarang', 'kecamatan' => 'Semarang Tengah', 'desa' => 'Purwodinatan'],
            '12.71.10.1001' => ['provinsi' => 'Sumatera Utara', 'kotkab' => 'Medan', 'kecamatan' => 'Medan Kota', 'desa' => 'Pusat Pasar'],
        ];

        return $locationMap[$adm4Code] ?? [
            'provinsi' => 'Unknown',
            'kotkab' => 'Unknown',
            'kecamatan' => 'Unknown',
            'desa' => 'Unknown',
        ];
    }
}
