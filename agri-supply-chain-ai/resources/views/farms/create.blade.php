<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            🌾 Tambah Lahan Baru
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-green-50 to-emerald-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-6">
                    <h3 class="text-lg font-bold text-white">Form Registrasi Lahan Pertanian</h3>
                    <p class="text-green-100 text-sm mt-1">Masukkan detail lahan Anda untuk mulai monitoring</p>
                </div>

                <form action="{{ route('farms.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <!-- Nama Lahan -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lahan</label>
                        <input type="text" id="name" name="name" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Contoh: Sawah Utama, Kebun Jeruk, dll">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                        <textarea id="location" name="location" rows="2" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Contoh: Desa Maju, Kecamatan Subang, Jawa Barat"></textarea>
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Luas Lahan -->
                    <div>
                        <label for="area" class="block text-sm font-semibold text-gray-700 mb-2">Luas Lahan (Hektare)</label>
                        <input type="number" id="area" name="area" step="0.01" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            placeholder="Contoh: 2.5">
                        @error('area')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Tanaman -->
                    <div>
                        <label for="crop_type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Tanaman</label>
                        <select id="crop_type" name="crop_type" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                            <option value="">-- Pilih Jenis Tanaman --</option>
                            <option value="Padi">🌾 Padi</option>
                            <option value="Jagung">🌽 Jagung</option>
                            <option value="Kedelai">🫘 Kedelai</option>
                            <option value="Cabai">🌶️ Cabai</option>
                            <option value="Tomat">🍅 Tomat</option>
                            <option value="Bawang">🧅 Bawang</option>
                            <option value="Wortel">🥕 Wortel</option>
                            <option value="Tebu">🍃 Tebu</option>
                            <option value="Sayuran Hijau">🥬 Sayuran Hijau</option>
                            <option value="Buah-buahan">🍊 Buah-buahan</option>
                        </select>
                        @error('crop_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Tanah -->
                    <div>
                        <label for="soil_type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Tanah</label>
                        <select id="soil_type" name="soil_type" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                            <option value="">-- Pilih Jenis Tanah --</option>
                            <option value="Lempung Berpasir">Lempung Berpasir</option>
                            <option value="Lempung">Lempung</option>
                            <option value="Lempung Berliat">Lempung Berliat</option>
                            <option value="Pasir">Pasir</option>
                            <option value="Pasir Berlempung">Pasir Berlempung</option>
                            <option value="Batu Liat">Batu Liat</option>
                            <option value="Organik">Organik</option>
                        </select>
                        @error('soil_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-3 px-4 rounded-lg transition transform hover:scale-105">
                            ✅ Simpan Lahan
                        </button>
                        <a href="{{ route('farms.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-4 rounded-lg transition text-center">
                            ❌ Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                <h4 class="font-bold text-blue-900 mb-2">💡 Tips:</h4>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>✓ Pastikan luas lahan sudah akurat untuk perhitungan lebih baik</li>
                    <li>✓ Pilih jenis tanaman sesuai dengan rencana penanaman Anda</li>
                    <li>✓ Jenis tanah mempengaruhi kebutuhan nutrisi tanaman</li>
                    <li>✓ Anda bisa menambah lebih dari satu lahan</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
