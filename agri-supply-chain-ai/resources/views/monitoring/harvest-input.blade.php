<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            🌾 Input Data Panen
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-green-50 via-blue-50 to-emerald-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">📝 Form Input Data Hasil Panen</h3>
                    <p class="text-gray-600">Masukkan informasi hasil panen Anda di sini</p>
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

                <form action="{{ route('harvest-input.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Farm Selection -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📍 Pilih Lahan <span class="text-red-500">*</span>
                            </label>
                            <select name="farm_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">-- Pilih Lahan --</option>
                                @foreach($farms as $farm)
                                <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                                    {{ $farm->name }} ({{ $farm->area }} ha - {{ $farm->location }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Crop Type -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                🌾 Jenis Tanaman <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="crop_type" value="{{ old('crop_type') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Contoh: Padi, Jagung, Cabai">
                        </div>

                        <!-- Planting Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📅 Tanggal Tanam <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="planting_date" value="{{ old('planting_date') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <!-- Estimated Harvest Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📅 Perkiraan Tanggal Panen <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="estimated_harvest_date" value="{{ old('estimated_harvest_date') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <!-- Actual Harvest Date -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📅 Tanggal Panen Aktual (opsional)
                            </label>
                            <input type="date" name="actual_harvest_date" value="{{ old('actual_harvest_date') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <!-- Estimated Yield -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📊 Perkiraan Hasil Panen <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="estimated_yield" value="{{ old('estimated_yield') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Contoh: 5000">
                        </div>

                        <!-- Actual Yield -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📊 Hasil Panen Aktual (opsional)
                            </label>
                            <input type="number" step="0.01" name="actual_yield" value="{{ old('actual_yield') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Contoh: 4800">
                        </div>

                        <!-- Yield Unit -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📦 Satuan <span class="text-red-500">*</span>
                            </label>
                            <select name="yield_unit" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="Kg" {{ old('yield_unit') == 'Kg' ? 'selected' : '' }}>Kilogram (Kg)</option>
                                <option value="Ton" {{ old('yield_unit') == 'Ton' ? 'selected' : '' }}>Ton</option>
                                <option value="Kuintal" {{ old('yield_unit') == 'Kuintal' ? 'selected' : '' }}>Kuintal</option>
                            </select>
                        </div>

                        <!-- Production Cost -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                💰 Biaya Produksi (Rp)
                            </label>
                            <input type="number" step="0.01" name="production_cost" value="{{ old('production_cost') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Contoh: 5000000">
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📌 Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="Dalam Proses" {{ old('status') == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <!-- Notes -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📝 Catatan (opsional)
                            </label>
                            <textarea name="notes" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                      placeholder="Tambahkan catatan atau informasi tambahan...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg transition shadow-lg">
                            💾 Simpan Data Panen
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
