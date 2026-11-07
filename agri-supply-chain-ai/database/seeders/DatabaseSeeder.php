<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Farm;
use App\Models\WeatherData;
use App\Models\HarvestData;
use App\Models\MarketPrice;
use App\Models\WaterUsage;
use App\Models\FertilizerUsage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create test users
        $user1 = User::create([
            'name' => 'Petani Maju',
            'email' => 'petani@example.com',
            'password' => bcrypt('password123'),
        ]);

        $user2 = User::create([
            'name' => 'Petani Makmur',
            'email' => 'petani2@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Create farms for user 1
        $farm1 = Farm::create([
            'user_id' => $user1->id,
            'name' => 'Sawah Subur',
            'location' => 'Desa Sumberejo, Kecamatan Sumbergempol',
            'area' => 2.5,
            'crop_type' => 'Padi',
            'soil_type' => 'Lempung Berpasir',
        ]);

        $farm2 = Farm::create([
            'user_id' => $user1->id,
            'name' => 'Kebun Jagung',
            'location' => 'Desa Bendogerit, Kecamatan Sumbergempol',
            'area' => 1.8,
            'crop_type' => 'Jagung',
            'soil_type' => 'Tanah Merah',
        ]);

        // Create farms for user 2
        $farm3 = Farm::create([
            'user_id' => $user2->id,
            'name' => 'Lahan Subak',
            'location' => 'Desa Bedoeloe, Ubud',
            'area' => 3.2,
            'crop_type' => 'Padi',
            'soil_type' => 'Tanah Hitam Subur',
        ]);

        // Create weather data
        $weatherDates = [
            ['date' => now()->subDays(7), 'temp_max' => 32, 'temp_min' => 24, 'humidity' => 85, 'rainfall' => 12.5],
            ['date' => now()->subDays(6), 'temp_max' => 31, 'temp_min' => 23, 'humidity' => 82, 'rainfall' => 8.0],
            ['date' => now()->subDays(5), 'temp_max' => 33, 'temp_min' => 25, 'humidity' => 88, 'rainfall' => 15.2],
            ['date' => now()->subDays(4), 'temp_max' => 32, 'temp_min' => 24, 'humidity' => 83, 'rainfall' => 10.1],
            ['date' => now()->subDays(3), 'temp_max' => 31, 'temp_min' => 23, 'humidity' => 80, 'rainfall' => 0],
            ['date' => now()->subDays(2), 'temp_max' => 34, 'temp_min' => 26, 'humidity' => 75, 'rainfall' => 0],
            ['date' => now()->subDays(1), 'temp_max' => 33, 'temp_min' => 25, 'humidity' => 78, 'rainfall' => 5.3],
            ['date' => now(), 'temp_max' => 32, 'temp_min' => 24, 'humidity' => 82, 'rainfall' => 8.7],
        ];

        foreach ($weatherDates as $data) {
            WeatherData::create([
                'farm_id' => $farm1->id,
                'date' => $data['date'],
                'temperature_max' => $data['temp_max'],
                'temperature_min' => $data['temp_min'],
                'humidity' => $data['humidity'],
                'rainfall' => $data['rainfall'],
                'wind_speed' => rand(5, 20),
                'weather_condition' => $data['rainfall'] > 5 ? 'Hujan' : 'Cerah',
            ]);
        }

        // Create harvest data
        HarvestData::create([
            'farm_id' => $farm1->id,
            'crop_type' => 'Padi',
            'planting_date' => now()->subMonths(3),
            'estimated_harvest_date' => now()->addDays(15),
            'actual_harvest_date' => null,
            'estimated_yield' => 12.5,
            'actual_yield' => null,
            'yield_unit' => 'ton',
            'production_cost' => 5000000,
            'status' => 'growing',
            'notes' => 'Kondisi pertumbuhan sangat baik',
        ]);

        HarvestData::create([
            'farm_id' => $farm1->id,
            'crop_type' => 'Padi',
            'planting_date' => now()->subMonths(6),
            'estimated_harvest_date' => now()->subMonths(2),
            'actual_harvest_date' => now()->subMonths(2)->addDays(3),
            'estimated_yield' => 11.8,
            'actual_yield' => 12.2,
            'yield_unit' => 'ton',
            'production_cost' => 4800000,
            'status' => 'completed',
            'notes' => 'Hasil panen melebihi estimasi',
        ]);

        // Create market prices
        $products = ['Padi', 'Jagung', 'Kacang Tanah', 'Tomat', 'Cabai', 'Bawang Merah'];
        $locations = ['Pasar Induk Jakarta', 'Pasar Raya Surabaya', 'Pasar Tradisional Bandung', 'Pasar Modern Yogyakarta'];

        foreach ($products as $product) {
            foreach ($locations as $location) {
                MarketPrice::create([
                    'product_name' => $product,
                    'market_location' => $location,
                    'price_per_unit' => rand(3000, 15000),
                    'unit' => 'kg',
                    'date' => now(),
                    'demand_level' => rand(1, 10),
                    'trend' => rand(0, 2) === 0 ? 'naik' : (rand(0, 1) === 0 ? 'turun' : 'stabil'),
                ]);
            }
        }

        // Create water usage data
        for ($i = 0; $i < 10; $i++) {
            WaterUsage::create([
                'farm_id' => $farm1->id,
                'date' => now()->subDays($i),
                'water_amount' => rand(50, 200),
                'water_source' => ['Sumur', 'Mata Air', 'Pompa', 'Irigasi Jaringan'][rand(0, 3)],
                'irrigation_method' => ['Irigasi Tetes', 'Irigasi Alur', 'Irigasi Genang', 'Penyiraman Manual'][rand(0, 3)],
                'water_cost' => rand(50000, 200000),
                'notes' => 'Kondisi air cukup untuk pertumbuhan tanaman',
            ]);
        }

        // Create fertilizer usage data
        $fertilizerTypes = ['Urea', 'SP-36', 'KCl', 'Pupuk Organik', 'NPK'];
        for ($i = 0; $i < 15; $i++) {
            FertilizerUsage::create([
                'farm_id' => $farm1->id,
                'date' => now()->subDays($i),
                'fertilizer_type' => $fertilizerTypes[rand(0, 4)],
                'quantity' => rand(10, 50),
                'unit' => 'kg',
                'fertilizer_cost' => rand(100000, 500000),
                'application_method' => ['Tabur', 'Disemprotkan', 'Dicampur dengan air', 'Dikubur'][rand(0, 3)],
                'notes' => 'Aplikasi pupuk sesuai jadwal',
            ]);
        }
    }
}
