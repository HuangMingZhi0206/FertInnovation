<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800">
            🧪 Input Data Penggunaan Pupuk
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-green-50 via-blue-50 to-emerald-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">📝 Form Input Data Penggunaan Pupuk</h3>
                    <p class="text-gray-600">Catat penggunaan pupuk untuk lahan Anda</p>
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

                <form action="{{ route('fertilizer-input.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Farm Selection -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📍 Pilih Lahan <span class="text-red-500">*</span>
                            </label>
                            <select name="farm_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
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
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>

                        <!-- Fertilizer Type -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                🧪 Jenis Pupuk <span class="text-red-500">*</span>
                            </label>
                            <select name="fertilizer_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="">-- Pilih Jenis Pupuk --</option>
                                <option value="Urea" {{ old('fertilizer_type') == 'Urea' ? 'selected' : '' }}>Urea</option>
                                <option value="NPK" {{ old('fertilizer_type') == 'NPK' ? 'selected' : '' }}>NPK</option>
                                <option value="TSP" {{ old('fertilizer_type') == 'TSP' ? 'selected' : '' }}>TSP (Triple Super Phosphate)</option>
                                <option value="ZA" {{ old('fertilizer_type') == 'ZA' ? 'selected' : '' }}>ZA (Zwavelzure Ammoniak)</option>
                                <option value="KCL" {{ old('fertilizer_type') == 'KCL' ? 'selected' : '' }}>KCL (Kalium Klorida)</option>
                                <option value="Organik" {{ old('fertilizer_type') == 'Organik' ? 'selected' : '' }}>Pupuk Organik</option>
                                <option value="Kompos" {{ old('fertilizer_type') == 'Kompos' ? 'selected' : '' }}>Kompos</option>
                                <option value="Kandang" {{ old('fertilizer_type') == 'Kandang' ? 'selected' : '' }}>Pupuk Kandang</option>
                                <option value="Lainnya" {{ old('fertilizer_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📦 Kuantitas <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Contoh: 50">
                        </div>

                        <!-- Unit -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                ⚖️ Satuan <span class="text-red-500">*</span>
                            </label>
                            <select name="unit" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="Kg" {{ old('unit') == 'Kg' ? 'selected' : '' }}>Kilogram (Kg)</option>
                                <option value="Liter" {{ old('unit') == 'Liter' ? 'selected' : '' }}>Liter</option>
                                <option value="Karung" {{ old('unit') == 'Karung' ? 'selected' : '' }}>Karung</option>
                                <option value="Ton" {{ old('unit') == 'Ton' ? 'selected' : '' }}>Ton</option>
                            </select>
                        </div>

                        <!-- Fertilizer Cost -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                💰 Biaya Pupuk (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="fertilizer_cost" value="{{ old('fertilizer_cost') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Contoh: 250000">
                        </div>

                        <!-- Application Method -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                🌱 Metode Aplikasi <span class="text-red-500">*</span>
                            </label>
                            <select name="application_method" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="">-- Pilih Metode --</option>
                                <option value="Sebar" {{ old('application_method') == 'Sebar' ? 'selected' : '' }}>Sebar</option>
                                <option value="Tugal" {{ old('application_method') == 'Tugal' ? 'selected' : '' }}>Tugal</option>
                                <option value="Semprot" {{ old('application_method') == 'Semprot' ? 'selected' : '' }}>Semprot</option>
                                <option value="Kocor" {{ old('application_method') == 'Kocor' ? 'selected' : '' }}>Kocor</option>
                                <option value="Larikan" {{ old('application_method') == 'Larikan' ? 'selected' : '' }}>Larikan</option>
                                <option value="Lainnya" {{ old('application_method') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Notes -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📝 Catatan (opsional)
                            </label>
                            <textarea name="notes" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                      placeholder="Tambahkan catatan seperti kondisi tanaman, target hasil, dll...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <button type="submit" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-6 rounded-lg transition shadow-lg">
                            💾 Simpan Data Pupuk
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
