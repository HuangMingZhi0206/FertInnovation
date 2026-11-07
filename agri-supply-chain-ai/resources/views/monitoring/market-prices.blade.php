<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">�� Harga Pasar</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Pantau Harga Produk Pertanian di Berbagai Pasar</h3>
                <table class="w-full text-sm">
                    <thead class="bg-gray-100"><tr><th class="p-2 text-left">Produk</th><th class="p-2">Pasar</th><th class="p-2 text-right">Harga</th><th class="p-2">Trend</th><th class="p-2">Demand</th></tr></thead>
                    <tbody>
                        @for($i = 0; $i < 12; $i++)
                        <tr class="border-t hover:bg-gray-50"><td class="p-2">Padi/Jagung/Cabai</td><td class="p-2">Pasar Induk/Tradisional</td><td class="p-2 text-right font-bold">Rp 5.000-15.000</td><td class="p-2"><span class="text-green-600">📈</span></td><td class="p-2">{{ rand(3,9) }}/10</td></tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
