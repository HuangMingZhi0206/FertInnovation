<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            ✏️ Edit Lahan: {{ $farm->name }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-yellow-50 to-orange-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-6">
                    <h3 class="text-lg font-bold text-white">Update Data Lahan Pertanian</h3>
                    <p class="text-yellow-100 text-sm mt-1">Perbarui informasi lahan Anda</p>
                </div>

                <form action="{{ route('farms.update', $farm) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Nama Lahan -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lahan</label>
                        <input type="text" id="name" name="name" required value="{{ $farm->name }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                        <textarea id="location" name="location" rows="2" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">{{ $farm->location }}</textarea>
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Luas Lahan -->
                    <div>
                        <label for="area" class="block text-sm font-semibold text-gray-700 mb-2">Luas Lahan (Hektare)</label>
                        <input type="number" id="area" name="area" step="0.01" required value="{{ $farm->area }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">
                        @error('area')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Tanaman -->
                    <div>
                        <label for="crop_type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Tanaman</label>
                        <select id="crop_type" name="crop_type" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">
                            <option value="">-- Pilih Jenis Tanaman --</option>
                            <option value="Padi" {{ $farm->crop_type == 'Padi' ? 'selected' : '' }}>🌾 Padi</option>
                            <option value="Jagung" {{ $farm->crop_type == 'Jagung' ? 'selected' : '' }}>🌽 Jagung</option>
                            <option value="Kedelai" {{ $farm->crop_type == 'Kedelai' ? 'selected' : '' }}>🫘 Kedelai</option>
                            <option value="Cabai" {{ $farm->crop_type == 'Cabai' ? 'selected' : '' }}>🌶️ Cabai</option>
                            <option value="Tomat" {{ $farm->crop_type == 'Tomat' ? 'selected' : '' }}>🍅 Tomat</option>
                            <option value="Bawang" {{ $farm->crop_type == 'Bawang' ? 'selected' : '' }}>🧅 Bawang</option>
                            <option value="Wortel" {{ $farm->crop_type == 'Wortel' ? 'selected' : '' }}>🥕 Wortel</option>
                            <option value="Tebu" {{ $farm->crop_type == 'Tebu' ? 'selected' : '' }}>🍃 Tebu</option>
                            <option value="Sayuran Hijau" {{ $farm->crop_type == 'Sayuran Hijau' ? 'selected' : '' }}>🥬 Sayuran Hijau</option>
                            <option value="Buah-buahan" {{ $farm->crop_type == 'Buah-buahan' ? 'selected' : '' }}>🍊 Buah-buahan</option>
                        </select>
                        @error('crop_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Tanah -->
                    <div>
                        <label for="soil_type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Tanah</label>
                        <select id="soil_type" name="soil_type" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition">
                            <option value="">-- Pilih Jenis Tanah --</option>
                            <option value="Lempung Berpasir" {{ $farm->soil_type == 'Lempung Berpasir' ? 'selected' : '' }}>Lempung Berpasir</option>
                            <option value="Lempung" {{ $farm->soil_type == 'Lempung' ? 'selected' : '' }}>Lempung</option>
                            <option value="Lempung Berliat" {{ $farm->soil_type == 'Lempung Berliat' ? 'selected' : '' }}>Lempung Berliat</option>
                            <option value="Pasir" {{ $farm->soil_type == 'Pasir' ? 'selected' : '' }}>Pasir</option>
                            <option value="Pasir Berlempung" {{ $farm->soil_type == 'Pasir Berlempung' ? 'selected' : '' }}>Pasir Berlempung</option>
                            <option value="Batu Liat" {{ $farm->soil_type == 'Batu Liat' ? 'selected' : '' }}>Batu Liat</option>
                            <option value="Organik" {{ $farm->soil_type == 'Organik' ? 'selected' : '' }}>Organik</option>
                        </select>
                        @error('soil_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold py-3 px-4 rounded-lg transition transform hover:scale-105">
                            ✅ Update Lahan
                        </button>
                        <a href="{{ route('farms.show', $farm) }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-4 rounded-lg transition text-center">
                            ❌ Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
