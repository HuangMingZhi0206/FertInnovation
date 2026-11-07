@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">💰 Harga Pasar Real-time</h1>

        <!-- Filter by Product -->
        <div class="mb-6 flex flex-wrap gap-2">
            <a href="{{ route('market-prices.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Semua</a>
            @foreach ($products as $product)
            <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">{{ $product }}</a>
            @endforeach
        </div>

        <!-- Market Prices Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($prices as $price)
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $price->product_name }}</h3>
                    <p class="text-sm text-gray-500">{{ $price->market_location }}</p>
                </div>
                <div class="px-6 py-4">
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($price->price_per_unit, 0, ',', '.') }}/{{ $price->unit }}</p>
                    <div class="mt-4 flex justify-between text-sm">
                        <span class="text-gray-600">Permintaan: <strong class="text-gray-900">{{ $price->demand_level }}/10</strong></span>
                        <span class="{{ $price->trend === 'Naik' ? 'text-red-600' : 'text-gray-600' }}">
                            {{ $price->trend === 'Naik' ? '📈 Naik' : '➡️ Stabil' }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 mt-3">Update: {{ $price->date->format('d M Y') }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500">Belum ada data harga pasar</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $prices->links() }}
        </div>
    </div>
</div>
@endsection
