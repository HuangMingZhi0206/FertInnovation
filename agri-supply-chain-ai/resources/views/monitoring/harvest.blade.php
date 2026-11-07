<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">🌾 Data Hasil Panen</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Rencana & Hasil Panen</h3>
                <table class="w-full text-sm"><thead class="bg-gray-100"><tr><th class="p-2">Tanaman</th><th class="p-2">Tgl Tanam</th><th class="p-2">Est. Panen</th><th class="p-2">Estimasi</th><th class="p-2">Status</th></tr></thead><tbody>
                @for($i = 0; $i < 5; $i++)<tr class="border-t"><td class="p-2">Padi</td><td class="p-2">{{ now()->subMonths(4)->format('d-m-Y') }}</td><td class="p-2">{{ now()->addDays(10)->format('d-m-Y') }}</td><td class="p-2">12-15 ton/ha</td><td class="p-2"><span class="bg-yellow-100 px-2 rounded">Proses</span></td></tr>@endfor
                </tbody></table>
            </div>
        </div>
    </div>
</x-app-layout>
