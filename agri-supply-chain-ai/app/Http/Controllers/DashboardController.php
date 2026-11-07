<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\WeatherData;
use App\Models\HarvestData;
use App\Models\MarketPrice;
use App\Models\WaterUsage;
use App\Models\FertilizerUsage;
use App\Services\BmkgWeatherService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's farms
        $farms = Farm::where('user_id', $user->id)->with(['weatherData' => function($q) {
            $q->orderBy('date', 'desc')->limit(1);
        }])->get();
        
        // Get total statistics
        $farmCount = $farms->count();
        $totalArea = $farms->sum('area');
        
        // Get latest weather data from all user's farms
        $latestWeather = WeatherData::whereIn('farm_id', $farms->pluck('id'))
            ->orderBy('date', 'desc')
            ->first();
        
        // Get harvest data
        $activeHarvests = HarvestData::whereIn('farm_id', $farms->pluck('id'))
            ->where('status', 'Dalam Proses')
            ->count();
        
        // Get harvest statistics
        $totalHarvests = HarvestData::whereIn('farm_id', $farms->pluck('id'))->count();
        $completedHarvests = HarvestData::whereIn('farm_id', $farms->pluck('id'))
            ->where('status', 'Selesai')
            ->count();
        
        // Get market prices (top 5 trending)
        $marketPrices = MarketPrice::orderBy('date', 'desc')
            ->limit(5)
            ->get();
        
        // Get total water and fertilizer usage this month
        $thisMonth = now()->startOfMonth();
        $waterUsageThisMonth = WaterUsage::whereIn('farm_id', $farms->pluck('id'))
            ->where('date', '>=', $thisMonth)
            ->sum('water_amount');
        
        $fertilizerUsageThisMonth = FertilizerUsage::whereIn('farm_id', $farms->pluck('id'))
            ->where('date', '>=', $thisMonth)
            ->sum('fertilizer_cost');
        
        $totalFertilizerCost = FertilizerUsage::whereIn('farm_id', $farms->pluck('id'))
            ->sum('fertilizer_cost');

        // BMKG forecast (cached)
        $bmkgService = new BmkgWeatherService();
        $bmkgData = $bmkgService->fetchForecast();
        $bmkgForecasts = $bmkgData['forecasts'];
        $bmkgNextForecast = $bmkgForecasts[0] ?? null;

        return view('dashboard.index', [
            'farmCount' => $farmCount,
            'totalFarms' => $farmCount,
            'totalArea' => $totalArea,
            'latestWeather' => $latestWeather,
            'activeHarvests' => $activeHarvests,
            'totalHarvests' => $totalHarvests,
            'completedHarvests' => $completedHarvests,
            'marketPrices' => $marketPrices,
            'waterUsageThisMonth' => $waterUsageThisMonth,
            'fertilizerUsageThisMonth' => $fertilizerUsageThisMonth,
            'totalFertilizerCost' => $totalFertilizerCost,
            'farms' => $farms,
            'bmkgNextForecast' => $bmkgNextForecast,
            'bmkgForecasts' => $bmkgForecasts,
        ]);
    }
}
