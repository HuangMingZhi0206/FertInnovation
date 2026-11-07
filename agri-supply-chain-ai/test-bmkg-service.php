<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$service = new App\Services\BmkgWeatherService();
$data = $service->fetchForecast('31.71.03.1001');

echo "Testing BMKG Service...\n";
echo "ADM4 Code: 31.71.03.1001 (Jakarta Pusat)\n";
echo "Forecasts count: " . count($data['forecasts']) . "\n";

if (count($data['forecasts']) > 0) {
    echo "✅ BMKG Service is working!\n";
    echo "First forecast:\n";
    print_r($data['forecasts'][0]);
} else {
    echo "❌ No forecasts returned\n";
    echo "Full response:\n";
    print_r($data);
}
