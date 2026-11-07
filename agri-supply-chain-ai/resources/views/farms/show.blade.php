<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            🌾 Detail Lahan: {{ $farm->name }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-green-50 to-emerald-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-white">{{ $farm->name }}</h1>
                            <p class="text-green-100 mt-2">{{ $farm->location }}</p>
                        </div>
                        <div class="text-6xl">🌾</div>
                    </div>
                </div>

                <!-- Farm Details Grid -->
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Luas Lahan -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 border-l-4 border-blue-500">
                        <p class="text-gray-600 text-sm font-semibold mb-1">📏 Luas Lahan</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $farm->area }} ha</p>
                        <p class="text-gray-500 text-xs mt-2">Total area</p>
                    </div>

                    <!-- Jenis Tanaman -->
                    <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl p-6 border-l-4 border-yellow-500">
                        <p class="text-gray-600 text-sm font-semibold mb-1">🌱 Jenis Tanaman</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $farm->crop_type }}</p>
                        <p class="text-gray-500 text-xs mt-2">Tanaman utama</p>
                    </div>

                    <!-- Jenis Tanah -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border-l-4 border-green-500">
                        <p class="text-gray-600 text-sm font-semibold mb-1">🌍 Jenis Tanah</p>
                        <p class="text-2xl font-bold text-green-600">{{ $farm->soil_type }}</p>
                        <p class="text-gray-500 text-xs mt-2">Komposisi tanah</p>
                    </div>

                    <!-- Tanggal Registrasi -->
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border-l-4 border-purple-500">
                        <p class="text-gray-600 text-sm font-semibold mb-1">📅 Terdaftar Sejak</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $farm->created_at->format('d M Y') }}</p>
                        <p class="text-gray-500 text-xs mt-2">{{ $farm->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Weather Data -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        🌤️ Data Cuaca Terbaru
                    </h3>
                    @if($farm->weatherData()->latest()->first())
                        @php $weather = $farm->weatherData()->latest()->first(); @endphp
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Suhu Max:</span>
                                <span class="font-bold text-red-600">{{ $weather->temperature_max }}°C</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Suhu Min:</span>
                                <span class="font-bold text-blue-600">{{ $weather->temperature_min }}°C</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kelembaban:</span>
                                <span class="font-bold text-green-600">{{ $weather->humidity }}%</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Hujan:</span>
                                <span class="font-bold text-blue-600">{{ $weather->rainfall }} mm</span>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada data cuaca</p>
                    @endif
                </div>

                <!-- Harvest Data -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        🌾 Status Panen
                    </h3>
                    @php
                        $harvests = $farm->harvestData()->get();
                        $completed = $harvests->where('status', 'Selesai')->count();
                        $inProgress = $harvests->where('status', 'Dalam Proses')->count();
                    @endphp
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Panen:</span>
                            <span class="font-bold text-purple-600">{{ $harvests->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Selesai:</span>
                            <span class="font-bold text-green-600">{{ $completed }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dalam Proses:</span>
                            <span class="font-bold text-yellow-600">{{ $inProgress }}</span>
                        </div>
                    </div>
                </div>

                <!-- Water & Fertilizer -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                        💧 Input Pertanian
                    </h3>
                    @php
                        $totalWater = $farm->waterUsage()->sum('water_amount');
                        $totalFertilizer = $farm->fertilizerUsage()->sum('fertilizer_cost');
                    @endphp
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Air:</span>
                            <span class="font-bold text-blue-600">{{ $totalWater }} L</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Pupuk:</span>
                            <span class="font-bold text-red-600">Rp {{ number_format($totalFertilizer, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 mb-6">
                <a href="{{ route('farms.edit', $farm) }}" class="flex-1 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold py-3 px-4 rounded-lg transition text-center transform hover:scale-105">
                    ✏️ Edit Lahan
                </a>
                <form action="{{ route('farms.destroy', $farm) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus lahan ini? Data tidak bisa dikembalikan!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white font-bold py-3 px-4 rounded-lg transition transform hover:scale-105">
                        🗑️ Hapus Lahan
                    </button>
                </form>
                <a href="{{ route('farms.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-lg transition text-center">
                    ← Kembali
                </a>
            </div>

            <!-- Weather Data Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">📊 Data Cuaca Historis</h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                                    <th class="px-4 py-3 text-center font-semibold">Suhu Max</th>
                                    <th class="px-4 py-3 text-center font-semibold">Suhu Min</th>
                                    <th class="px-4 py-3 text-center font-semibold">Kelembaban</th>
                                    <th class="px-4 py-3 text-center font-semibold">Hujan</th>
                                    <th class="px-4 py-3 text-left font-semibold">Kondisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($farm->weatherData()->latest()->limit(10)->get() as $weather)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $weather->date->format('d M Y') }}</td>
                                        <td class="px-4 py-3 text-center"><span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">{{ $weather->temperature_max }}°C</span></td>
                                        <td class="px-4 py-3 text-center"><span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">{{ $weather->temperature_min }}°C</span></td>
                                        <td class="px-4 py-3 text-center">{{ $weather->humidity }}%</td>
                                        <td class="px-4 py-3 text-center">{{ $weather->rainfall }} mm</td>
                                        <td class="px-4 py-3">{{ $weather->weather_condition }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada data cuaca</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
