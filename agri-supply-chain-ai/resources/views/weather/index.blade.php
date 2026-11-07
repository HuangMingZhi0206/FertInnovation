@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📊 Monitoring Cuaca</h1>
            <button onclick="document.getElementById('weatherForm').style.display='block'" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                + Tambah Data Cuaca
            </button>
        </div>

        <!-- Weather Data Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Lahan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Suhu Max</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Suhu Min</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Kelembaban</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Curah Hujan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Kondisi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($weatherData as $data)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $data->date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $data->farm->name }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-red-600">{{ $data->temperature_max }}°C</td>
                        <td class="px-6 py-4 text-sm font-semibold text-blue-600">{{ $data->temperature_min }}°C</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $data->humidity }}%</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $data->rainfall }} mm</td>
                        <td class="px-6 py-4 text-sm"><span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">{{ $data->weather_condition }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada data cuaca</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $weatherData->links() }}
        </div>
    </div>
</div>
@endsection
