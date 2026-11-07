<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">💧 Manajemen Air</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Pantau & Kelola Penggunaan Air Secara Efisien</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-cyan-50 p-4 rounded-lg"><p class="text-sm">Penggunaan Hari Ini</p><p class="text-2xl font-bold text-cyan-600">150 L</p></div>
                    <div class="bg-cyan-50 p-4 rounded-lg"><p class="text-sm">Biaya Air</p><p class="text-2xl font-bold text-cyan-600">Rp 75.000</p></div>
                    <div class="bg-cyan-50 p-4 rounded-lg"><p class="text-sm">Sumber Air</p><p class="text-2xl font-bold text-cyan-600">Sumur</p></div>
                </div>
                <table class="w-full text-sm"><thead class="bg-gray-100"><tr><th class="p-2">Tanggal</th><th class="p-2">Jumlah</th><th class="p-2">Metode</th><th class="p-2">Biaya</th></tr></thead><tbody>
                @for($i=0;$i<10;$i++)<tr class="border-t"><td class="p-2">{{ now()->subDays($i)->format('d-m-Y') }}</td><td class="p-2">{{ rand(100,300) }} L</td><td class="p-2">Irigasi Genang</td><td class="p-2">Rp {{ rand(50000,300000) }}</td></tr>@endfor
                </tbody></table>
            </div>
        </div>
    </div>
</x-app-layout>
