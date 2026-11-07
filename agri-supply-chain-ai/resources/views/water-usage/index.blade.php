@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">💧 Manajemen Penggunaan Air</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600 text-sm">Total Air Bulan Ini</p>
                <p class="text-2xl font-bold text-blue-600">{{ $water->sum('water_amount') ?? 0 }} m³</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600 text-sm">Total Biaya Air</p>
                <p class="text-2xl font-bold text-green-600">Rp {{ number_format($water->sum('water_cost') ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Lahan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Volume</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Sumber</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Metode Irigasi</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Biaya</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($water as $w)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $w->date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $w->farm->name }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-blue-600">{{ $w->water_amount }} m³</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $w->water_source }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $w->irrigation_method }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($w->water_cost, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data penggunaan air</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $water->links() }}
        </div>
    </div>
</div>
@endsection
