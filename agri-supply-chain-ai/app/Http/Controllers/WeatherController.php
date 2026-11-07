<?php

namespace App\Http\Controllers;

use App\Models\WeatherData;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $farms = Farm::where('user_id', $user->id)->get();
        $weatherData = WeatherData::whereIn('farm_id', $farms->pluck('id'))
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('weather.index', compact('weatherData', 'farms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'date' => 'required|date',
            'temperature_max' => 'required|numeric',
            'temperature_min' => 'required|numeric',
            'humidity' => 'required|numeric',
            'rainfall' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'weather_condition' => 'required|string',
        ]);

        WeatherData::create($request->all());
        return redirect()->route('weather.index')->with('success', 'Data cuaca berhasil ditambahkan');
    }
}
