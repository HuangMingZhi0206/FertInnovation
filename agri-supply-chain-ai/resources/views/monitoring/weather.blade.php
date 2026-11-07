<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Monitoring Cuaca
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Data Cuaca Pertanian</h3>
                    <p class="text-gray-600 mb-6">Monitor kondisi cuaca setiap hari untuk perencanaan tanam yang optimal</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                        @foreach(['Suhu Maksimal', 'Suhu Minimal', 'Kelembaban', 'Curah Hujan', 'Kecepatan Angin', 'Kondisi'] as $metric)
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <p class="text-sm text-gray-600">{{ $metric }}</p>
                                <p class="text-xl font-bold text-blue-600 mt-2">-- </p>
                            </div>
                        @endforeach
                    </div>
                    
                    <h4 class="text-md font-semibold mt-6 mb-3">Riwayat Cuaca</h4>
                    <table class="w-full text-sm border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-2 text-left">Tanggal</th>
                                <th class="border p-2 text-left">Suhu Max</th>
                                <th class="border p-2 text-left">Suhu Min</th>
                                <th class="border p-2 text-left">Kelembaban</th>
                                <th class="border p-2 text-left">Curah Hujan</th>
                                <th class="border p-2 text-left">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < 10; $i++)
                                <tr class="hover:bg-gray-50">
                                    <td class="border p-2">{{ now()->subDays($i)->format('d-m-Y') }}</td>
                                    <td class="border p-2 text-red-600">32-34°C</td>
                                    <td class="border p-2 text-blue-600">23-25°C</td>
                                    <td class="border p-2">75-88%</td>
                                    <td class="border p-2">0-15 mm</td>
                                    <td class="border p-2"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Cerah Berawan</span></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
