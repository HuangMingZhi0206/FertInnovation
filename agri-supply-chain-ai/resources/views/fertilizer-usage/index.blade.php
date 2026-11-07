@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">🌱 Manajemen Penggunaan Pupuk</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600 text-sm">Total Pupuk</p>
                <p class="text-2xl font-bold text-green-600">{{ $fertilizers->sum('quantity') ?? 0 }} kg</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600 text-sm">Total Biaya Pupuk</p>
                <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($fertilizers->sum('fertilizer_cost') ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Lahan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Jenis Pupuk</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Kuantitas</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Metode Aplikasi</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Biaya</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($fertilizers as $fert)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $fert->date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $fert->farm->name }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-green-600">{{ $fert->fertilizer_type }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $fert->quantity }} {{ $fert->unit }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $fert->application_method }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($fert->fertilizer_cost, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data penggunaan pupuk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $fertilizers->links() }}
        </div>
    </div>
</div>
@endsection
