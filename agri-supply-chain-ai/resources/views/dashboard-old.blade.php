@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Pertanian Cerdas</h1>
            <p class="mt-2 text-gray-600">Selamat datang, {{ Auth::user()->name }}! 👋</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Lahan -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 truncate">Total Lahan</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $farmCount }}</p>
                        </div>
                        <div class="text-green-500 text-3xl">🌾</div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <a href="{{ route('farms.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
                        Lihat semua →
                    </a>
                </div>
            </div>

            <!-- Total Area -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 truncate">Luas Total</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($totalArea, 2) }} ha</p>
                        </div>
                        <div class="text-blue-500 text-3xl">📍</div>
                    </div>
                </div>
            </div>

            <!-- Active Harvests -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 truncate">Panen Aktif</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $activeHarvests }}</p>
                        </div>
                        <div class="text-yellow-500 text-3xl">🌾</div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <a href="{{ route('harvest.index') }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-500">
                        Kelola panen →
                    </a>
                </div>
            </div>

            <!-- Latest Weather -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 truncate">Cuaca Terkini</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">
                                @if ($latestWeather)
                                    {{ $latestWeather->temperature_max }}°C
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <div class="text-indigo-500 text-3xl">☁️</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Weather Information -->
                @if ($latestWeather)
                <div class="bg-white overflow-hidden shadow rounded-lg mb-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">📊 Informasi Cuaca Terkini</h2>
                    </div>
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-blue-50 p-4 rounded">
                                <p class="text-sm text-gray-600">Suhu Max</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $latestWeather->temperature_max }}°C</p>
                            </div>
                            <div class="bg-cyan-50 p-4 rounded">
                                <p class="text-sm text-gray-600">Suhu Min</p>
                                <p class="text-2xl font-bold text-cyan-600">{{ $latestWeather->temperature_min }}°C</p>
                            </div>
                            <div class="bg-indigo-50 p-4 rounded">
                                <p class="text-sm text-gray-600">Kelembaban</p>
                                <p class="text-2xl font-bold text-indigo-600">{{ $latestWeather->humidity }}%</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded">
                                <p class="text-sm text-gray-600">Curah Hujan</p>
                                <p class="text-2xl font-bold text-green-600">{{ $latestWeather->rainfall }} mm</p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded">
                                <p class="text-sm text-gray-600">Kecepatan Angin</p>
                                <p class="text-2xl font-bold text-purple-600">{{ $latestWeather->wind_speed }} km/h</p>
                            </div>
                            <div class="bg-orange-50 p-4 rounded">
                                <p class="text-sm text-gray-600">Kondisi</p>
                                <p class="text-lg font-bold text-orange-600">{{ $latestWeather->weather_condition }}</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-4">Data terupdate: {{ $latestWeather->date->format('d M Y') }}</p>
                    </div>
                </div>
                @endif

                <!-- Water and Fertilizer Usage This Month -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">💧 Penggunaan Air Bulan Ini</h2>
                        </div>
                        <div class="px-6 py-4">
                            <p class="text-3xl font-bold text-blue-600">{{ number_format($waterUsageThisMonth, 0) }} m³</p>
                            <p class="text-sm text-gray-500 mt-2">Total volume air yang digunakan</p>
                            <a href="{{ route('water-usage.index') }}" class="text-blue-600 text-sm font-medium mt-3 inline-block hover:underline">
                                Lihat detail →
                            </a>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">🌱 Biaya Pupuk Bulan Ini</h2>
                        </div>
                        <div class="px-6 py-4">
                            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($fertilizerUsageThisMonth, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500 mt-2">Total biaya pupuk yang dikeluarkan</p>
                            <a href="{{ route('fertilizer-usage.index') }}" class="text-green-600 text-sm font-medium mt-3 inline-block hover:underline">
                                Lihat detail →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <a href="{{ route('weather.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition">
                        📊 Cuaca
                    </a>
                    <a href="{{ route('harvest.index') }}" class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition">
                        🌾 Panen
                    </a>
                    <a href="{{ route('market-prices.index') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition">
                        💰 Harga
                    </a>
                    <a href="{{ route('water-usage.index') }}" class="bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition">
                        �� Air
                    </a>
                    <a href="{{ route('fertilizer-usage.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition">
                        🌱 Pupuk
                    </a>
                    <a href="{{ route('chatbot.index') }}" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition">
                        🤖 AI Chat
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Market Prices -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">💰 Harga Pasar Trending</h2>
                    </div>
                    <div class="divide-y">
                        @forelse ($marketPrices as $price)
                        <div class="px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $price->product_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $price->market_location }}</p>
                                </div>
                            </div>
                            <div class="mt-2 flex justify-between items-center">
                                <p class="text-lg font-semibold text-green-600">Rp {{ number_format($price->price_per_unit, 0, ',', '.') }}/{{ $price->unit }}</p>
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $price->trend === 'Naik' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $price->trend }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Permintaan: Level {{ $price->demand_level }}/10</p>
                        </div>
                        @empty
                        <div class="px-6 py-8 text-center">
                            <p class="text-gray-500">Belum ada data harga pasar</p>
                        </div>
                        @endforelse
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <a href="{{ route('market-prices.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
                            Lihat semua →
                        </a>
                    </div>
                </div>

                <!-- Farm List -->
                <div class="bg-white overflow-hidden shadow rounded-lg mt-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">📋 Daftar Lahan</h2>
                    </div>
                    <div class="divide-y">
                        @forelse ($farms as $farm)
                        <div class="px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $farm->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $farm->location }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $farm->crop_type }} • {{ $farm->area }} ha</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="px-6 py-8 text-center">
                            <p class="text-gray-500">Belum ada data lahan</p>
                            <a href="{{ route('farms.create') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 mt-2 inline-block">
                                Tambah lahan →
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
