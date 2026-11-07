<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            🌾 Dashboard Pertanian Cerdas
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-green-50 via-blue-50 to-emerald-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="mb-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex-1">
                        <h1 class="text-4xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }} 👋</h1>
                        <p class="text-green-100 text-lg mb-4">Kelola pertanian Anda dengan teknologi AI canggih</p>
                        <div class="flex items-center gap-3">
                            <button onclick="getCurrentLocationWeather()" id="locationBtn" class="bg-white text-green-600 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-green-50 transition flex items-center gap-2 shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span id="locationBtnText">Gunakan Lokasi Saya</span>
                            </button>
                            <div id="locationInfo" class="text-green-100 text-sm hidden">
                                <span id="locationName">📍 Memuat lokasi...</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-6xl opacity-80">🌾</div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Lahan -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-green-500 hover:shadow-xl transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600 text-sm font-semibold">📍 Total Lahan</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalFarms ?? 0 }}</h3>
                            <p class="text-green-600 text-xs mt-1 font-semibold">{{ $totalArea ?? 0 }} Hektar</p>
                        </div>
                    </div>
                </div>

                <!-- Cuaca -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-blue-500 hover:shadow-xl transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600 text-sm font-semibold">🌤️ Cuaca Hari Ini</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $latestWeather?->temperature_max ?? '28' }}°C</h3>
                            <p class="text-blue-600 text-xs mt-1 font-semibold">{{ $latestWeather?->weather_condition ?? 'Cerah' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Hasil Panen -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-yellow-500 hover:shadow-xl transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600 text-sm font-semibold">🌾 Hasil Panen</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $completedHarvests ?? 0 }}/{{ $totalHarvests ?? 0 }}</h3>
                            <p class="text-yellow-600 text-xs mt-1 font-semibold">Selesai</p>
                        </div>
                    </div>
                </div>

                <!-- Biaya Pupuk -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-red-500 hover:shadow-xl transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600 text-sm font-semibold">💰 Biaya Pupuk</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalFertilizerCost ?? 0, 0, ',', '.') }}</h3>
                            <p class="text-red-600 text-xs mt-1 font-semibold">Total investasi</p>
                        </div>
                    </div>
                </div>

                @if(isset($bmkgNextForecast))
                <!-- BMKG Forecast -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-indigo-500 hover:shadow-xl transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600 text-sm font-semibold">🌦️ Prakiraan BMKG</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $bmkgNextForecast['t'] ?? '?' }}°C</h3>
                            <p class="text-indigo-600 text-xs mt-1 font-semibold">{{ $bmkgNextForecast['weather_desc'] ?? '' }}</p>
                            @php
                                $forecastTime = isset($bmkgNextForecast['local_datetime']) ? \Carbon\Carbon::parse($bmkgNextForecast['local_datetime']) : null;
                            @endphp
                            <p class="text-gray-500 text-xs mt-2">{{ $forecastTime ? $forecastTime->format('d M H:i') : '' }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Temperature Chart -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">📊 Suhu 7 Hari Terakhir</h3>
                    <canvas id="temperatureChart" style="max-height: 300px;"></canvas>
                </div>

                <!-- Harvest Chart -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">🌾 Status Hasil Panen</h3>
                    <canvas id="harvestChart" style="max-height: 300px;"></canvas>
                </div>

                <!-- Water Chart -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">💧 Penggunaan Air</h3>
                    <canvas id="waterChart" style="max-height: 300px;"></canvas>
                </div>

                <!-- Fertilizer Chart -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">🧪 Biaya Pupuk per Farm</h3>
                    <canvas id="fertilizerChart" style="max-height: 300px;"></canvas>
                </div>
            </div>

            <!-- Weather Table -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">📋 Data Cuaca Terkini</h3>
                    <span class="text-xs text-gray-500 bg-blue-100 px-3 py-1 rounded-full">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full animate-pulse mr-1"></span>
                        Data dari BMKG API
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal & Waktu</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-700">Suhu</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-700">Kelembaban</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-700">Hujan</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-700">Angin</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $weatherList = [];
                                foreach($farms as $farm) {
                                    foreach($farm->weatherData()->latest()->limit(7)->get() as $w) {
                                        $weatherList[] = $w;
                                    }
                                }
                                $weatherList = collect($weatherList)->sortByDesc('date')->unique('date')->take(7);
                                
                                // If no database weather data, use BMKG forecasts
                                $displayData = $weatherList->isNotEmpty() ? 'database' : 'bmkg';
                            @endphp
                            
                            @if($displayData === 'database')
                                @foreach($weatherList as $weather)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-semibold text-gray-800">{{ $weather->date->format('d M Y') }}</td>
                                        <td class="px-4 py-3 text-center"><span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">{{ $weather->temperature_max }}°C</span></td>
                                        <td class="px-4 py-3 text-center"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">{{ $weather->humidity }}%</span></td>
                                        <td class="px-4 py-3 text-center">{{ $weather->rainfall }} mm</td>
                                        <td class="px-4 py-3 text-center">{{ $weather->wind_speed }} km/j</td>
                                        <td class="px-4 py-3">
                                            @if(str_contains(strtolower($weather->weather_condition), 'cerah'))
                                                <span class="text-yellow-600 font-semibold">☀️ {{ $weather->weather_condition }}</span>
                                            @elseif(str_contains(strtolower($weather->weather_condition), 'hujan'))
                                                <span class="text-blue-600 font-semibold">🌧️ {{ $weather->weather_condition }}</span>
                                            @elseif(str_contains(strtolower($weather->weather_condition), 'berawan') || str_contains(strtolower($weather->weather_condition), 'mendung'))
                                                <span class="text-gray-600 font-semibold">☁️ {{ $weather->weather_condition }}</span>
                                            @else
                                                <span class="text-gray-600 font-semibold">{{ $weather->weather_condition }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif(isset($bmkgForecasts) && count($bmkgForecasts) > 0)
                                @foreach(array_slice($bmkgForecasts, 0, 10) as $forecast)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 font-semibold text-gray-800">
                                            @php
                                                $dt = \Carbon\Carbon::parse($forecast['local_datetime'] ?? '');
                                            @endphp
                                            {{ $dt->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">{{ $forecast['t'] ?? '-' }}°C</span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">{{ $forecast['hu'] ?? '-' }}%</span>
                                        </td>
                                        <td class="px-4 py-3 text-center">{{ $forecast['tp'] ?? 0 }} mm</td>
                                        <td class="px-4 py-3 text-center">{{ $forecast['ws'] ?? '-' }} km/j</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $condition = $forecast['weather_desc'] ?? '';
                                            @endphp
                                            @if(str_contains(strtolower($condition), 'cerah'))
                                                <span class="text-yellow-600 font-semibold">☀️ {{ $condition }}</span>
                                            @elseif(str_contains(strtolower($condition), 'hujan'))
                                                <span class="text-blue-600 font-semibold">🌧️ {{ $condition }}</span>
                                            @elseif(str_contains(strtolower($condition), 'berawan') || str_contains(strtolower($condition), 'mendung'))
                                                <span class="text-gray-600 font-semibold">☁️ {{ $condition }}</span>
                                            @else
                                                <span class="text-gray-600 font-semibold">{{ $condition }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                        <div class="py-4">
                                            <p class="mb-2">Belum ada data cuaca</p>
                                            <p class="text-xs text-gray-400">BMKG API mungkin sedang tidak tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Market Prices -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-6">💰 Harga Pasar Terkini</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($marketPrices->take(6) as $price)
                        <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-lg p-4 border-l-4 border-orange-500">
                            <p class="font-bold text-gray-800">{{ $price->product_name }}</p>
                            <p class="text-xs text-gray-600 mt-1">{{ $price->market_location }}</p>
                            <p class="text-2xl font-bold text-green-600 mt-3">Rp {{ number_format($price->price_per_unit, 0, ',', '.') }}</p>
                            <div class="flex justify-between items-center mt-3">
                                @if($price->trend == 'naik')
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">📈 Naik</span>
                                @elseif($price->trend == 'turun')
                                    <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded">📉 Turun</span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-2 py-1 rounded">➡️ Stabil</span>
                                @endif
                                <span class="text-xs text-gray-600">Permintaan: {{ $price->demand_level }}/10</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8 text-gray-500">
                            Belum ada data harga pasar
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Links -->
            <div class="mb-6">
                <a href="{{ route('monitoring') }}" class="block bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-6 py-4 rounded-xl text-center font-bold text-lg transition shadow-lg mb-4">
                    📊 Lihat Dashboard Monitoring Lengkap →
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
                <a href="{{ route('farms.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-3 rounded-lg text-center font-semibold text-sm transition">
                    🌾 Lahan
                </a>
                <a href="{{ route('weather') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-3 rounded-lg text-center font-semibold text-sm transition">
                    🌤️ Cuaca
                </a>
                <a href="{{ route('market-prices') }}" class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-4 py-3 rounded-lg text-center font-semibold text-sm transition">
                    💰 Harga
                </a>
                <a href="{{ route('harvest') }}" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-4 py-3 rounded-lg text-center font-semibold text-sm transition">
                    🌾 Panen
                </a>
                <a href="{{ route('water-management') }}" class="bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white px-4 py-3 rounded-lg text-center font-semibold text-sm transition">
                    💧 Air
                </a>
                <a href="{{ route('fertilizer-management') }}" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-3 rounded-lg text-center font-semibold text-sm transition">
                    🧪 Pupuk
                </a>
                <a href="{{ route('chatbot') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-4 py-3 rounded-lg text-center font-semibold text-sm transition">
                    🤖 Chat
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prepare data
            @php
                $weatherDates = [];
                $tempMax = [];
                $tempMin = [];
                $weatherList = [];
                foreach($farms as $farm) {
                    foreach($farm->weatherData()->latest()->limit(7)->get() as $w) {
                        $weatherList[] = $w;
                    }
                }
                $weatherList = collect($weatherList)->sortBy('date')->unique('date')->take(7);
                foreach($weatherList as $w) {
                    $weatherDates[] = $w->date->format('d M');
                    $tempMax[] = $w->temperature_max;
                    $tempMin[] = $w->temperature_min;
                }
            @endphp

            // Temperature Chart
            const tempCtx = document.getElementById('temperatureChart');
            if (tempCtx) {
                new Chart(tempCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($weatherDates) !!},
                        datasets: [
                            {
                                label: 'Suhu Max',
                                data: {!! json_encode($tempMax) !!},
                                borderColor: '#EF4444',
                                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4,
                                pointRadius: 4
                            },
                            {
                                label: 'Suhu Min',
                                data: {!! json_encode($tempMin) !!},
                                borderColor: '#3B82F6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4,
                                pointRadius: 4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: true }
                        }
                    }
                });
            }

            // Harvest Chart
            const harvestCtx = document.getElementById('harvestChart');
            if (harvestCtx) {
                new Chart(harvestCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Selesai', 'Dalam Proses'],
                        datasets: [{
                            data: [{{ $completedHarvests ?? 0 }}, {{ ($totalHarvests ?? 0) - ($completedHarvests ?? 0) }}],
                            backgroundColor: ['#10B981', '#F59E0B'],
                            borderColor: ['#059669', '#D97706'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } }
                    }
                });
            }

            // Water Chart
            const waterCtx = document.getElementById('waterChart');
            if (waterCtx) {
                @php
                    $farmNames = [];
                    $waterData = [];
                    foreach($farms as $farm) {
                        $farmNames[] = $farm->name;
                        $waterData[] = $farm->waterUsage()->sum('water_amount');
                    }
                @endphp

                new Chart(waterCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($farmNames) !!},
                        datasets: [{
                            label: 'Air (Liter)',
                            data: {!! json_encode($waterData) !!},
                            backgroundColor: ['#06B6D4', '#0EA5E9', '#3B82F6'],
                            borderWidth: 1,
                            borderRadius: 8
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } }
                    }
                });
            }

            // Fertilizer Chart
            const fertilizerCtx = document.getElementById('fertilizerChart');
            if (fertilizerCtx) {
                @php
                    $farmNames2 = [];
                    $fertilizerData = [];
                    foreach($farms as $farm) {
                        $farmNames2[] = $farm->name;
                        $fertilizerData[] = $farm->fertilizerUsage()->sum('fertilizer_cost');
                    }
                @endphp

                new Chart(fertilizerCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($farmNames2) !!},
                        datasets: [{
                            label: 'Biaya (Rp)',
                            data: {!! json_encode($fertilizerData) !!},
                            backgroundColor: ['#EF4444', '#F43F5E', '#EC4899'],
                            borderWidth: 1,
                            borderRadius: 8
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } }
                    }
                });
            }
        });

        // Geolocation function to get current location weather
        function getCurrentLocationWeather() {
            const btn = document.getElementById('locationBtn');
            const btnText = document.getElementById('locationBtnText');
            const locationInfo = document.getElementById('locationInfo');
            const locationName = document.getElementById('locationName');

            if (!navigator.geolocation) {
                alert('⚠️ Browser Anda tidak mendukung Geolocation API');
                return;
            }

            // Update button state
            btnText.textContent = 'Mendapatkan Lokasi...';
            btn.disabled = true;
            locationInfo.classList.remove('hidden');
            locationName.textContent = '📍 Mengambil koordinat GPS...';

            navigator.geolocation.getCurrentPosition(
                async function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    
                    locationName.textContent = `📍 Lat: ${lat.toFixed(4)}, Lon: ${lon.toFixed(4)}`;

                    try {
                        // Fetch weather data based on coordinates
                        const url = `{{ route('api.weather.location') }}?lat=${lat}&lon=${lon}`;
                        console.log('Fetching weather from:', url);
                        
                        const response = await fetch(url, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            credentials: 'same-origin'
                        });

                        console.log('Response status:', response.status);

                        // Parse JSON response regardless of status
                        const data = await response.json();
                        console.log('Weather data received:', data);

                        // Handle response based on status and data
                        if (response.ok && data.success) {
                            // Success - show location
                            const locationText = data.location.note 
                                ? `📍 ${data.location.kecamatan}, ${data.location.kotkab} (${data.location.note})`
                                : `📍 ${data.location.kecamatan}, ${data.location.kotkab}`;
                            
                            locationName.innerHTML = locationText;
                            
                            // Show notification with note if available
                            const message = data.location.note 
                                ? '✅ ' + data.location.note
                                : '✅ Data cuaca lokasi Anda berhasil dimuat!';
                            
                            showNotification(message, 'success');
                            
                            // Reload page after delay to show updated data
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000);
                        } else if (response.status === 503) {
                            // Service unavailable
                            locationName.textContent = '⚠️ BMKG API sedang tidak tersedia';
                            showNotification('⚠️ Layanan cuaca BMKG sedang tidak tersedia. Coba lagi nanti.', 'warning');
                        } else {
                            // Other errors
                            locationName.textContent = '⚠️ ' + (data.message || 'Data cuaca tidak tersedia');
                            showNotification('⚠️ ' + (data.message || 'Data tidak tersedia'), 'warning');
                        }
                    } catch (error) {
                        console.error('Error fetching weather:', error);
                        locationName.textContent = '❌ Gagal mengambil data cuaca';
                        showNotification('❌ Terjadi kesalahan: ' + error.message, 'error');
                    } finally {
                        btnText.textContent = 'Gunakan Lokasi Saya';
                        btn.disabled = false;
                    }
                },
                function(error) {
                    let message = '';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            message = 'Akses lokasi ditolak. Mohon izinkan akses lokasi di browser Anda.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            message = 'Informasi lokasi tidak tersedia.';
                            break;
                        case error.TIMEOUT:
                            message = 'Waktu permintaan lokasi habis.';
                            break;
                        default:
                            message = 'Terjadi kesalahan yang tidak diketahui.';
                    }
                    
                    locationName.textContent = '❌ ' + message;
                    btnText.textContent = 'Gunakan Lokasi Saya';
                    btn.disabled = false;
                    showNotification('❌ ' + message, 'error');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        }

        // Notification helper function
        function showNotification(message, type = 'info') {
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };

            const notification = document.createElement('div');
            notification.className = `fixed top-20 right-4 ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-fade-in-down`;
            notification.innerHTML = `
                <div class="flex items-center gap-3">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-20px)';
                notification.style.transition = 'all 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        // Add CSS for animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-fade-in-down {
                animation: fadeInDown 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>

