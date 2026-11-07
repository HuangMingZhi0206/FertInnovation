<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            📊 Monitoring Pertanian
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-green-50 via-blue-50 to-emerald-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Navigation Tabs -->
            <div class="bg-white rounded-xl shadow-lg p-4 mb-8">
                <div class="flex flex-wrap gap-3">
                    <button onclick="showTab('temperature')" id="tab-temperature" class="tab-btn active px-6 py-3 rounded-lg font-semibold text-sm transition">
                        📊 Suhu 7 Hari
                    </button>
                    <button onclick="showTab('harvest')" id="tab-harvest" class="tab-btn px-6 py-3 rounded-lg font-semibold text-sm transition">
                        🌾 Status Panen
                    </button>
                    <button onclick="showTab('water')" id="tab-water" class="tab-btn px-6 py-3 rounded-lg font-semibold text-sm transition">
                        💧 Penggunaan Air
                    </button>
                    <button onclick="showTab('fertilizer')" id="tab-fertilizer" class="tab-btn px-6 py-3 rounded-lg font-semibold text-sm transition">
                        🧪 Biaya Pupuk
                    </button>
                </div>
            </div>

            <!-- Temperature Section -->
            <div id="section-temperature" class="tab-section">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500">
                        <p class="text-gray-600 text-sm font-semibold">🔥 Suhu Rata-rata</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ number_format($avgTemp, 1) }}°C</h3>
                        <p class="text-red-600 text-xs mt-2">7 hari terakhir</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500">
                        <p class="text-gray-600 text-sm font-semibold">📈 Suhu Tertinggi</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ number_format($maxTemp, 1) }}°C</h3>
                        <p class="text-orange-600 text-xs mt-2">{{ $maxTempDate }}</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                        <p class="text-gray-600 text-sm font-semibold">📉 Suhu Terendah</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ number_format($minTemp, 1) }}°C</h3>
                        <p class="text-blue-600 text-xs mt-2">{{ $minTempDate }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">📊 Grafik Suhu 7 Hari Terakhir</h3>
                    <canvas id="tempMonitorChart" style="max-height: 400px;"></canvas>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">📋 Detail Data Suhu</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Suhu Max</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Suhu Min</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Rata-rata</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Kelembaban</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Kondisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weatherData as $weather)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-semibold">{{ $weather->date->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full font-semibold">{{ $weather->temperature_max }}°C</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">{{ $weather->temperature_min }}°C</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full font-semibold">{{ number_format(($weather->temperature_max + $weather->temperature_min) / 2, 1) }}°C</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $weather->humidity }}%</td>
                                    <td class="px-4 py-3">{{ $weather->weather_condition }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Harvest Section -->
            <div id="section-harvest" class="tab-section hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                        <p class="text-gray-600 text-sm font-semibold">✅ Panen Selesai</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $completedHarvests }}</h3>
                        <p class="text-green-600 text-xs mt-2">Total hasil panen</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
                        <p class="text-gray-600 text-sm font-semibold">⏳ Dalam Proses</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $activeHarvests }}</h3>
                        <p class="text-yellow-600 text-xs mt-2">Sedang berlangsung</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                        <p class="text-gray-600 text-sm font-semibold">📊 Total Hasil</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ number_format($totalYield, 2) }}</h3>
                        <p class="text-blue-600 text-xs mt-2">Ton</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">🌾 Status Panen</h3>
                        <canvas id="harvestStatusChart" style="max-height: 300px;"></canvas>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">📊 Hasil Panen per Farm</h3>
                        <canvas id="harvestPerFarmChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">📋 Riwayat Panen</h3>
                        <a href="{{ route('harvest-input') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold text-sm transition">
                            + Input Data Panen
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Farm</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Komoditas</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Tanggal Tanam</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Target Panen</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Hasil Panen</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($harvestData as $harvest)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-semibold">{{ $harvest->farm->name }}</td>
                                    <td class="px-4 py-3">{{ $harvest->crop_type }}</td>
                                    <td class="px-4 py-3 text-center">{{ $harvest->planting_date->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-center">{{ $harvest->estimated_yield }} {{ $harvest->yield_unit }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if($harvest->actual_yield)
                                            <span class="font-semibold text-green-600">{{ $harvest->actual_yield }} {{ $harvest->yield_unit }}</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($harvest->status == 'Selesai')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">✅ Selesai</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">⏳ Proses</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Water Section -->
            <div id="section-water" class="tab-section hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                        <p class="text-gray-600 text-sm font-semibold">💧 Total Air</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ number_format($totalWater, 0) }}</h3>
                        <p class="text-blue-600 text-xs mt-2">Liter</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-cyan-500">
                        <p class="text-gray-600 text-sm font-semibold">💰 Biaya Air</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalWaterCost, 0, ',', '.') }}</h3>
                        <p class="text-cyan-600 text-xs mt-2">Total biaya</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-indigo-500">
                        <p class="text-gray-600 text-sm font-semibold">📊 Rata-rata/Hari</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ number_format($avgWaterPerDay, 0) }}</h3>
                        <p class="text-indigo-600 text-xs mt-2">Liter</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">💧 Penggunaan Air per Farm</h3>
                        <canvas id="waterPerFarmChart" style="max-height: 300px;"></canvas>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">📈 Tren Penggunaan Air</h3>
                        <canvas id="waterTrendChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">📋 Riwayat Penggunaan Air</h3>
                        <a href="{{ route('water-input') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold text-sm transition">
                            + Input Data Air
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Farm</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Jumlah (L)</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Sumber</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Metode</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($waterUsageData as $water)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-semibold">{{ $water->date->format('d M Y') }}</td>
                                    <td class="px-4 py-3">{{ $water->farm->name }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">{{ number_format($water->water_amount, 0) }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $water->water_source }}</td>
                                    <td class="px-4 py-3 text-center">{{ $water->irrigation_method }}</td>
                                    <td class="px-4 py-3 text-center">Rp {{ number_format($water->water_cost, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Fertilizer Section -->
            <div id="section-fertilizer" class="tab-section hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500">
                        <p class="text-gray-600 text-sm font-semibold">💰 Total Biaya</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalFertilizerCost, 0, ',', '.') }}</h3>
                        <p class="text-red-600 text-xs mt-2">Semua farm</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500">
                        <p class="text-gray-600 text-sm font-semibold">🧪 Total Kuantitas</p>
                        <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ number_format($totalFertilizerQty, 2) }}</h3>
                        <p class="text-orange-600 text-xs mt-2">Kg</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-pink-500">
                        <p class="text-gray-600 text-sm font-semibold">📊 Rata-rata/Farm</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($avgFertilizerPerFarm, 0, ',', '.') }}</h3>
                        <p class="text-pink-600 text-xs mt-2">Biaya pupuk</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">🧪 Biaya Pupuk per Farm</h3>
                        <canvas id="fertilizerPerFarmChart" style="max-height: 300px;"></canvas>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">📊 Jenis Pupuk</h3>
                        <canvas id="fertilizerTypesChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">📋 Riwayat Penggunaan Pupuk</h3>
                        <a href="{{ route('fertilizer-input') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold text-sm transition">
                            + Input Data Pupuk
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Farm</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Jenis Pupuk</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Kuantitas</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Biaya</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Metode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fertilizerUsageData as $fertilizer)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-semibold">{{ $fertilizer->date->format('d M Y') }}</td>
                                    <td class="px-4 py-3">{{ $fertilizer->farm->name }}</td>
                                    <td class="px-4 py-3">{{ $fertilizer->fertilizer_type }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full font-semibold">{{ $fertilizer->quantity }} {{ $fertilizer->unit }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full font-semibold">Rp {{ number_format($fertilizer->fertilizer_cost, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $fertilizer->application_method }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Tab functionality
        function showTab(tabName) {
            // Hide all sections
            document.querySelectorAll('.tab-section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-green-500', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
            });
            
            // Show selected section
            document.getElementById(`section-${tabName}`).classList.remove('hidden');
            
            // Add active class to selected button
            const activeBtn = document.getElementById(`tab-${tabName}`);
            activeBtn.classList.add('active', 'bg-green-500', 'text-white');
            activeBtn.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
        }

        // Initialize first tab
        showTab('temperature');

        // Temperature Chart
        @php
            $tempDates = [];
            $tempMaxData = [];
            $tempMinData = [];
            foreach($weatherData as $w) {
                $tempDates[] = $w->date->format('d M');
                $tempMaxData[] = $w->temperature_max;
                $tempMinData[] = $w->temperature_min;
            }
        @endphp

        const tempCtx = document.getElementById('tempMonitorChart');
        new Chart(tempCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($tempDates) !!},
                datasets: [{
                    label: 'Suhu Max',
                    data: {!! json_encode($tempMaxData) !!},
                    borderColor: '#EF4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }, {
                    label: 'Suhu Min',
                    data: {!! json_encode($tempMinData) !!},
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    y: { beginAtZero: false }
                }
            }
        });

        // Harvest Charts
        const harvestStatusCtx = document.getElementById('harvestStatusChart');
        new Chart(harvestStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Dalam Proses'],
                datasets: [{
                    data: [{{ $completedHarvests }}, {{ $activeHarvests }}],
                    backgroundColor: ['#10B981', '#F59E0B'],
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        @php
            $harvestFarmNames = [];
            $harvestFarmData = [];
            foreach($farms as $farm) {
                $harvestFarmNames[] = $farm->name;
                $harvestFarmData[] = $farm->harvestData()->sum('actual_yield') ?: 0;
            }
        @endphp

        const harvestPerFarmCtx = document.getElementById('harvestPerFarmChart');
        new Chart(harvestPerFarmCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($harvestFarmNames) !!},
                datasets: [{
                    label: 'Hasil Panen (Kg)',
                    data: {!! json_encode($harvestFarmData) !!},
                    backgroundColor: ['#10B981', '#14B8A6', '#06B6D4'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });

        // Water Charts
        @php
            $waterFarmNames = [];
            $waterFarmData = [];
            foreach($farms as $farm) {
                $waterFarmNames[] = $farm->name;
                $waterFarmData[] = $farm->waterUsage()->sum('water_amount');
            }
        @endphp

        const waterPerFarmCtx = document.getElementById('waterPerFarmChart');
        new Chart(waterPerFarmCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($waterFarmNames) !!},
                datasets: [{
                    label: 'Air (Liter)',
                    data: {!! json_encode($waterFarmData) !!},
                    backgroundColor: ['#06B6D4', '#0EA5E9', '#3B82F6'],
                    borderRadius: 8
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false
            }
        });

        @php
            $waterDates = [];
            $waterTrendData = [];
            $waterByDate = $waterUsageData->groupBy(function($item) {
                return $item->date->format('d M');
            });
            foreach($waterByDate as $date => $items) {
                $waterDates[] = $date;
                $waterTrendData[] = $items->sum('water_amount');
            }
        @endphp

        const waterTrendCtx = document.getElementById('waterTrendChart');
        new Chart(waterTrendCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($waterDates) !!},
                datasets: [{
                    label: 'Penggunaan Air (L)',
                    data: {!! json_encode($waterTrendData) !!},
                    borderColor: '#06B6D4',
                    backgroundColor: 'rgba(6, 182, 212, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Fertilizer Charts
        @php
            $fertFarmNames = [];
            $fertFarmData = [];
            foreach($farms as $farm) {
                $fertFarmNames[] = $farm->name;
                $fertFarmData[] = $farm->fertilizerUsage()->sum('fertilizer_cost');
            }
        @endphp

        const fertPerFarmCtx = document.getElementById('fertilizerPerFarmChart');
        new Chart(fertPerFarmCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($fertFarmNames) !!},
                datasets: [{
                    label: 'Biaya Pupuk (Rp)',
                    data: {!! json_encode($fertFarmData) !!},
                    backgroundColor: ['#EF4444', '#F43F5E', '#EC4899'],
                    borderRadius: 8
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false
            }
        });

        @php
            $fertTypes = [];
            $fertTypeData = [];
            $fertByType = $fertilizerUsageData->groupBy('fertilizer_type');
            foreach($fertByType as $type => $items) {
                $fertTypes[] = $type;
                $fertTypeData[] = $items->sum('fertilizer_cost');
            }
        @endphp

        const fertTypesCtx = document.getElementById('fertilizerTypesChart');
        new Chart(fertTypesCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($fertTypes) !!},
                datasets: [{
                    data: {!! json_encode($fertTypeData) !!},
                    backgroundColor: ['#EF4444', '#F59E0B', '#10B981', '#3B82F6', '#8B5CF6'],
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>
