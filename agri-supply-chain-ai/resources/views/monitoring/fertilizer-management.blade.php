<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">🌱 Manajemen Pupuk</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Aplikasi & Manajemen Pupuk Optimal</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-orange-50 p-4 rounded-lg"><p class="text-sm">Total Biaya Pupuk</p><p class="text-2xl font-bold text-orange-600">Rp 2.500.000</p></div>
                    <div class="bg-orange-50 p-4 rounded-lg"><p class="text-sm">Jenis Pupuk</p><p class="text-2xl font-bold text-orange-600">5 Jenis</p></div>
                    <div class="bg-orange-50 p-4 rounded-lg"><p class="text-sm">Efisiensi</p><p class="text-2xl font-bold text-orange-600">85%</p></div>
                </div>
                <table class="w-full text-sm"><thead class="bg-gray-100"><tr><th class="p-2">Tanggal</th><th class="p-2">Jenis Pupuk</th><th class="p-2">Jumlah</th><th class="p-2">Metode</th><th class="p-2">Biaya</th></tr></thead><tbody>
                @for($i=0;$i<10;$i++)<tr class="border-t"><td class="p-2">{{ now()->subDays($i)->format('d-m-Y') }}</td><td class="p-2">Urea/NPK</td><td class="p-2">{{ rand(10,50) }} kg</td><td class="p-2">Tabur/Cair</td><td class="p-2">Rp {{ rand(200000,500000) }}</td></tr>@endfor
                </tbody></table>
            </div>
        </div>
    </div>
</x-app-layout>
