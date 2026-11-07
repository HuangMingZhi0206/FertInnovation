<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                🌾 Manajemen Lahan Pertanian
            </h2>
            <a href="{{ route('farms.create') }}" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                + Tambah Lahan
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-green-50 to-emerald-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow p-4 border-l-4 border-green-500">
                    <p class="text-gray-600 text-sm font-semibold">Total Lahan</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $farms->count() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow p-4 border-l-4 border-blue-500">
                    <p class="text-gray-600 text-sm font-semibold">Total Area</p>
                    <p class="text-3xl font-bold text-blue-600 mt-1">{{ $farms->sum('area') }} ha</p>
                </div>
                <div class="bg-white rounded-xl shadow p-4 border-l-4 border-yellow-500">
                    <p class="text-gray-600 text-sm font-semibold">Jenis Tanaman</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $farms->pluck('crop_type')->unique()->count() }}</p>
                </div>
            </div>

            <!-- Farms Grid -->
            @if($farms->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($farms as $farm)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:scale-105">
                            <!-- Card Header -->
                            <div class="bg-gradient-to-r from-green-400 to-emerald-500 px-6 py-4 flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $farm->name }}</h3>
                                    <p class="text-green-100 text-sm mt-1">📍 {{ Str::limit($farm->location, 30) }}</p>
                                </div>
                                <div class="text-4xl">🌾</div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 space-y-4">
                                <!-- Details -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-blue-50 rounded-lg p-3">
                                        <p class="text-xs text-gray-600 font-semibold">Luas Lahan</p>
                                        <p class="text-lg font-bold text-blue-600 mt-1">{{ $farm->area }} ha</p>
                                    </div>
                                    <div class="bg-yellow-50 rounded-lg p-3">
                                        <p class="text-xs text-gray-600 font-semibold">Tanaman</p>
                                        <p class="text-lg font-bold text-yellow-600 mt-1">{{ Str::limit($farm->crop_type, 10) }}</p>
                                    </div>
                                </div>

                                <div class="bg-green-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-600 font-semibold">Jenis Tanah</p>
                                    <p class="text-sm font-bold text-green-600 mt-1">{{ $farm->soil_type }}</p>
                                </div>

                                <!-- Status Info -->
                                <div class="flex gap-2 pt-2">
                                    <span class="flex-1 bg-purple-100 text-purple-700 text-xs font-semibold px-2 py-1 rounded text-center">
                                        🌤️ Cuaca
                                    </span>
                                    <span class="flex-1 bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-1 rounded text-center">
                                        🌾 {{ $farm->harvestData()->count() }} Panen
                                    </span>
                                </div>
                            </div>

                            <!-- Card Footer Actions -->
                            <div class="border-t px-6 py-4 bg-gray-50 flex gap-2">
                                <a href="{{ route('farms.show', $farm) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-center text-sm font-semibold transition">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('farms.edit', $farm) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-center text-sm font-semibold transition">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('farms.destroy', $farm) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-semibold transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="text-6xl mb-4">🚜</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Lahan Terdaftar</h3>
                    <p class="text-gray-600 mb-6">Mulai dengan mendaftarkan lahan pertanian Anda terlebih dahulu</p>
                    <a href="{{ route('farms.create') }}" class="inline-block bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-3 px-8 rounded-lg transition transform hover:scale-105">
                        ➕ Buat Lahan Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
