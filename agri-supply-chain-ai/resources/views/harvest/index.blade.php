@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">🌾 Manajemen Hasil Panen</h1>

        <!-- Harvest Data Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Lahan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tanaman</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Estimasi Hasil</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Perkiraan Panen</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($harvests as $harvest)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $harvest->farm->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $harvest->crop_type }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $harvest->status === 'Dalam Proses' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ $harvest->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-green-600">{{ number_format($harvest->estimated_yield, 0) }} {{ $harvest->yield_unit }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $harvest->estimated_harvest_date->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data panen</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $harvests->links() }}
        </div>
    </div>
</div>
@endsection
