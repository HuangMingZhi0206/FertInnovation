<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\WeatherData;
use App\Models\HarvestData;
use App\Models\WaterUsage;
use App\Models\FertilizerUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $farms = Farm::where('user_id', $user->id)->get();
        $farmIds = $farms->pluck('id');

        // Weather Data - Last 7 days
        $weatherData = WeatherData::whereIn('farm_id', $farmIds)
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get()
            ->sortBy('date');

        // Calculate temperature statistics
        $avgTemp = $weatherData->avg(function($w) {
            return ($w->temperature_max + $w->temperature_min) / 2;
        });
        
        $maxTempRecord = $weatherData->sortByDesc('temperature_max')->first();
        $maxTemp = $maxTempRecord ? $maxTempRecord->temperature_max : 0;
        $maxTempDate = $maxTempRecord ? $maxTempRecord->date->format('d M Y') : '-';
        
        $minTempRecord = $weatherData->sortBy('temperature_min')->first();
        $minTemp = $minTempRecord ? $minTempRecord->temperature_min : 0;
        $minTempDate = $minTempRecord ? $minTempRecord->date->format('d M Y') : '-';

        // Harvest Data
        $harvestData = HarvestData::whereIn('farm_id', $farmIds)
            ->orderBy('planting_date', 'desc')
            ->get();
        
        $completedHarvests = $harvestData->where('status', 'Selesai')->count();
        $activeHarvests = $harvestData->where('status', 'Dalam Proses')->count();
        $totalYield = $harvestData->where('status', 'Selesai')->sum('actual_yield') / 1000; // Convert to tons

        // Water Usage Data
        $waterUsageData = WaterUsage::whereIn('farm_id', $farmIds)
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();
        
        $totalWater = $waterUsageData->sum('water_amount');
        $totalWaterCost = $waterUsageData->sum('water_cost');
        $avgWaterPerDay = $waterUsageData->count() > 0 ? $totalWater / $waterUsageData->count() : 0;

        // Fertilizer Usage Data
        $fertilizerUsageData = FertilizerUsage::whereIn('farm_id', $farmIds)
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();
        
        $totalFertilizerCost = $fertilizerUsageData->sum('fertilizer_cost');
        $totalFertilizerQty = $fertilizerUsageData->sum('quantity');
        $avgFertilizerPerFarm = $farms->count() > 0 ? $totalFertilizerCost / $farms->count() : 0;

        return view('monitoring.index', compact(
            'farms',
            'weatherData',
            'avgTemp',
            'maxTemp',
            'maxTempDate',
            'minTemp',
            'minTempDate',
            'harvestData',
            'completedHarvests',
            'activeHarvests',
            'totalYield',
            'waterUsageData',
            'totalWater',
            'totalWaterCost',
            'avgWaterPerDay',
            'fertilizerUsageData',
            'totalFertilizerCost',
            'totalFertilizerQty',
            'avgFertilizerPerFarm'
        ));
    }

    // Harvest Input Methods
    public function harvestInput()
    {
        $user = Auth::user();
        $farms = Farm::where('user_id', $user->id)->get();
        return view('monitoring.harvest-input', compact('farms'));
    }

    public function storeHarvestInput(Request $request)
    {
        $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'crop_type' => 'required|string|max:255',
            'planting_date' => 'required|date',
            'estimated_harvest_date' => 'required|date',
            'actual_harvest_date' => 'nullable|date',
            'estimated_yield' => 'required|numeric|min:0',
            'actual_yield' => 'nullable|numeric|min:0',
            'yield_unit' => 'required|string|in:Kg,Ton,Kuintal',
            'production_cost' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:Dalam Proses,Selesai',
            'notes' => 'nullable|string',
        ]);

        // Verify farm ownership
        $farm = Farm::where('id', $request->farm_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        HarvestData::create([
            'farm_id' => $request->farm_id,
            'crop_type' => $request->crop_type,
            'planting_date' => $request->planting_date,
            'estimated_harvest_date' => $request->estimated_harvest_date,
            'actual_harvest_date' => $request->actual_harvest_date,
            'estimated_yield' => $request->estimated_yield,
            'actual_yield' => $request->actual_yield,
            'yield_unit' => $request->yield_unit,
            'production_cost' => $request->production_cost ?? 0,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('monitoring')
            ->with('success', 'Data panen berhasil disimpan!');
    }

    // Water Input Methods
    public function waterInput()
    {
        $user = Auth::user();
        $farms = Farm::where('user_id', $user->id)->get();
        return view('monitoring.water-input', compact('farms'));
    }

    public function storeWaterInput(Request $request)
    {
        $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'date' => 'required|date',
            'water_amount' => 'required|numeric|min:0',
            'water_source' => 'required|string|max:255',
            'irrigation_method' => 'required|string|max:255',
            'water_cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Verify farm ownership
        $farm = Farm::where('id', $request->farm_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        WaterUsage::create([
            'farm_id' => $request->farm_id,
            'date' => $request->date,
            'water_amount' => $request->water_amount,
            'water_source' => $request->water_source,
            'irrigation_method' => $request->irrigation_method,
            'water_cost' => $request->water_cost,
            'notes' => $request->notes,
        ]);

        return redirect()->route('monitoring')
            ->with('success', 'Data penggunaan air berhasil disimpan!');
    }

    // Fertilizer Input Methods
    public function fertilizerInput()
    {
        $user = Auth::user();
        $farms = Farm::where('user_id', $user->id)->get();
        return view('monitoring.fertilizer-input', compact('farms'));
    }

    public function storeFertilizerInput(Request $request)
    {
        $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'date' => 'required|date',
            'fertilizer_type' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|in:Kg,Liter,Karung,Ton',
            'fertilizer_cost' => 'required|numeric|min:0',
            'application_method' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Verify farm ownership
        $farm = Farm::where('id', $request->farm_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        FertilizerUsage::create([
            'farm_id' => $request->farm_id,
            'date' => $request->date,
            'fertilizer_type' => $request->fertilizer_type,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'fertilizer_cost' => $request->fertilizer_cost,
            'application_method' => $request->application_method,
            'notes' => $request->notes,
        ]);

        return redirect()->route('monitoring')
            ->with('success', 'Data penggunaan pupuk berhasil disimpan!');
    }
}
