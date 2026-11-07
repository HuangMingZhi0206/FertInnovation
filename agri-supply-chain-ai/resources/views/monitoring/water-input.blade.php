<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            💧 Input Data Penggunaan Air
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-green-50 via-blue-50 to-emerald-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">📝 Form Input Data Penggunaan Air</h3>
                    <p class="text-gray-600">Catat penggunaan air untuk irigasi lahan Anda</p>
                </div>

                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    <p class="font-semibold">✅ {{ session('success') }}</p>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <p class="font-semibold">❌ Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('water-input.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Farm Selection -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📍 Pilih Lahan <span class="text-red-500">*</span>
                            </label>
                            <select name="farm_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Pilih Lahan --</option>
                                @foreach($farms as $farm)
                                <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                                    {{ $farm->name }} ({{ $farm->area }} ha - {{ $farm->location }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📅 Tanggal <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Water Amount -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                💧 Jumlah Air (Liter) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="water_amount" value="{{ old('water_amount') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Contoh: 5000">
                        </div>

                        <!-- Water Source -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                🚰 Sumber Air <span class="text-red-500">*</span>
                            </label>
                            <select name="water_source" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Pilih Sumber Air --</option>
                                <option value="Sumur" {{ old('water_source') == 'Sumur' ? 'selected' : '' }}>Sumur</option>
                                <option value="PDAM" {{ old('water_source') == 'PDAM' ? 'selected' : '' }}>PDAM</option>
                                <option value="Sungai" {{ old('water_source') == 'Sungai' ? 'selected' : '' }}>Sungai</option>
                                <option value="Waduk" {{ old('water_source') == 'Waduk' ? 'selected' : '' }}>Waduk</option>
                                <option value="Hujan" {{ old('water_source') == 'Hujan' ? 'selected' : '' }}>Air Hujan</option>
                                <option value="Lainnya" {{ old('water_source') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Irrigation Method -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                🌊 Metode Irigasi <span class="text-red-500">*</span>
                            </label>
                            <select name="irrigation_method" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Pilih Metode --</option>
                                <option value="Sprinkler" {{ old('irrigation_method') == 'Sprinkler' ? 'selected' : '' }}>Sprinkler</option>
                                <option value="Drip" {{ old('irrigation_method') == 'Drip' ? 'selected' : '' }}>Drip/Tetes</option>
                                <option value="Flood" {{ old('irrigation_method') == 'Flood' ? 'selected' : '' }}>Banjir/Genangan</option>
                                <option value="Manual" {{ old('irrigation_method') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                <option value="Lainnya" {{ old('irrigation_method') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Water Cost -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                💰 Biaya Air (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="water_cost" value="{{ old('water_cost') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Contoh: 50000">
                        </div>

                        <!-- Notes -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📝 Catatan (opsional)
                            </label>
                            <textarea name="notes" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Tambahkan catatan atau informasi tambahan...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-6 rounded-lg transition shadow-lg">
                            💾 Simpan Data Air
                        </button>
                        <a href="{{ route('monitoring') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-4 px-6 rounded-lg transition text-center">
                            ❌ Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
