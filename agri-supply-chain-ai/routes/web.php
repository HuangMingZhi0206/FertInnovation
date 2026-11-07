<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\Api\WeatherApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Weather API - accessible for authenticated users (AJAX calls from dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/api/weather/location', [WeatherApiController::class, 'getWeatherByLocation'])->name('api.weather.location');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Farm routes
    Route::resource('farms', FarmController::class);
    
    // Test page for Weather API
    Route::get('/test-weather-api', function() {
        return view('test-weather-api');
    })->name('test.weather.api');
    
    // Weather monitoring
    Route::get('/weather', function() {
        return view('monitoring.weather');
    })->name('weather');
    Route::get('/weather/index', function() {
        return view('monitoring.weather');
    })->name('weather.index');
    
    // Market prices
    Route::get('/market-prices', function() {
        return view('monitoring.market-prices');
    })->name('market-prices');
    Route::get('/market-prices/index', function() {
        return view('monitoring.market-prices');
    })->name('market-prices.index');
    
    // Harvest data
    Route::get('/harvest', function() {
        return view('monitoring.harvest');
    })->name('harvest');
    Route::get('/harvest/index', function() {
        return view('monitoring.harvest');
    })->name('harvest.index');
    
    // Water management
    Route::get('/water-management', function() {
        return view('monitoring.water-management');
    })->name('water-management');
    
    // Fertilizer management
    Route::get('/fertilizer-management', function() {
        return view('monitoring.fertilizer-management');
    })->name('fertilizer-management');
    
    // Chatbot
    Route::get('/chatbot', function() {
        return view('chatbot.index');
    })->name('chatbot');
    
    // Monitoring Dashboard
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
    
    // Harvest Input
    Route::get('/harvest-input', [MonitoringController::class, 'harvestInput'])->name('harvest-input');
    Route::post('/harvest-input', [MonitoringController::class, 'storeHarvestInput'])->name('harvest-input.store');
    
    // Water Input
    Route::get('/water-input', [MonitoringController::class, 'waterInput'])->name('water-input');
    Route::post('/water-input', [MonitoringController::class, 'storeWaterInput'])->name('water-input.store');
    
    // Fertilizer Input
    Route::get('/fertilizer-input', [MonitoringController::class, 'fertilizerInput'])->name('fertilizer-input');
    Route::post('/fertilizer-input', [MonitoringController::class, 'storeFertilizerInput'])->name('fertilizer-input.store');
});

require __DIR__.'/auth.php';
