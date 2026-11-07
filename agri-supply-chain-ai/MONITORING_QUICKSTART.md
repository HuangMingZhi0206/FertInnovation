# 🚀 Quick Start - Fitur Monitoring

## Untuk Petani

### 1️⃣ Akses Dashboard Monitoring
```
Login → Dashboard → Klik "📊 Lihat Dashboard Monitoring Lengkap"
```

### 2️⃣ Input Data Panen
```
Monitoring → Tab "🌾 Status Panen" → "+" Input Data Panen
```
**Field Wajib:**
- Pilih Lahan
- Jenis Tanaman (Padi/Jagung/Cabai/dll)
- Tanggal Tanam
- Target Tanggal Panen
- Perkiraan Hasil
- Status (Dalam Proses/Selesai)

### 3️⃣ Input Data Air
```
Monitoring → Tab "💧 Penggunaan Air" → "+" Input Data Air
```
**Field Wajib:**
- Pilih Lahan
- Tanggal
- Jumlah Air (Liter)
- Sumber Air (Sumur/PDAM/Sungai/dll)
- Metode Irigasi
- Biaya

### 4️⃣ Input Data Pupuk
```
Monitoring → Tab "🧪 Biaya Pupuk" → "+" Input Data Pupuk
```
**Field Wajib:**
- Pilih Lahan
- Tanggal
- Jenis Pupuk (Urea/NPK/TSP/Organik/dll)
- Kuantitas + Satuan
- Biaya
- Metode Aplikasi

## Untuk Developer

### Files Created
```
✅ resources/views/monitoring/index.blade.php
✅ resources/views/monitoring/harvest-input.blade.php
✅ resources/views/monitoring/water-input.blade.php
✅ resources/views/monitoring/fertilizer-input.blade.php
✅ app/Http/Controllers/MonitoringController.php
✅ routes/web.php (updated)
✅ resources/views/dashboard/index.blade.php (updated)
```

### Routes
```php
// Monitoring Dashboard
GET  /monitoring

// Harvest Input
GET  /harvest-input
POST /harvest-input

// Water Input
GET  /water-input
POST /water-input

// Fertilizer Input
GET  /fertilizer-input
POST /fertilizer-input
```

### Controller Methods
```php
MonitoringController:
- index()                    // Main monitoring dashboard
- harvestInput()             // Show harvest form
- storeHarvestInput()        // Save harvest data
- waterInput()               // Show water form
- storeWaterInput()          // Save water data
- fertilizerInput()          // Show fertilizer form
- storeFertilizerInput()     // Save fertilizer data
```

### Testing
```bash
# 1. Pastikan server running
php artisan serve

# 2. Login sebagai user
# 3. Akses /monitoring
# 4. Test setiap tab dan form input

# 5. Check database
php artisan tinker
>>> \App\Models\HarvestData::all()
>>> \App\Models\WaterUsage::all()
>>> \App\Models\FertilizerUsage::all()
```

## 📊 Visualisasi Data

### Chart Types
1. **Line Chart** - Suhu 7 hari (max & min)
2. **Doughnut Chart** - Status panen
3. **Bar Chart** - Hasil panen per farm
4. **Horizontal Bar** - Penggunaan air per farm
5. **Line Chart** - Tren air harian
6. **Horizontal Bar** - Biaya pupuk per farm
7. **Pie Chart** - Jenis pupuk breakdown

### Color Scheme
- 🔴 Red: Suhu Max & Pupuk
- 🔵 Blue: Suhu Min & Air
- 🟢 Green: Panen Selesai
- 🟡 Yellow: Panen Proses

## 🔐 Security
- ✅ Auth middleware pada semua route
- ✅ Farm ownership validation
- ✅ CSRF protection
- ✅ Input validation
- ✅ User hanya bisa akses data farm sendiri

## 💡 Tips
1. Input data secara rutin untuk tracking yang akurat
2. Gunakan tab untuk navigasi cepat antar monitoring
3. Lihat grafik untuk analisis tren
4. Check tabel detail untuk info lengkap
5. Tambahkan catatan di form untuk dokumentasi

## 🐛 Troubleshooting

### Data tidak muncul di grafik
- Pastikan sudah input data minimal 1 entry
- Refresh halaman
- Check browser console untuk error

### Form error saat submit
- Pastikan semua field wajib (*) terisi
- Check format tanggal
- Pastikan angka valid (tidak negatif)

### Chart tidak render
- Pastikan Chart.js CDN loaded
- Check browser console
- Clear cache browser

## 📱 Mobile Responsive
✅ Grid otomatis adjust
✅ Touch-friendly buttons
✅ Scrollable tables
✅ Stacked layout di mobile

## 🎯 Next Steps
1. Test semua form input ✅
2. Verifikasi data tersimpan di database ✅
3. Check visualisasi chart ✅
4. Test responsive di mobile ✅
5. Deploy ke production 🚀
