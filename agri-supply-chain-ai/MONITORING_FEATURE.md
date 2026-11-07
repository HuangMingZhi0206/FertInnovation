# 📊 Fitur Monitoring Pertanian

## Overview
Sistem monitoring pertanian yang lengkap dengan visualisasi data dan form input untuk petani mengelola data mereka sendiri.

## ✨ Fitur Utama

### 1. 📊 Monitoring Suhu 7 Hari Terakhir
- **Grafik suhu**: Line chart menampilkan suhu maksimal dan minimal
- **Statistik suhu**:
  - Suhu rata-rata 7 hari
  - Suhu tertinggi + tanggal
  - Suhu terendah + tanggal
- **Tabel detail**: Data lengkap per hari dengan kelembaban dan kondisi cuaca

### 2. 🌾 Monitoring Status Hasil Panen
- **Doughnut chart**: Visualisasi status panen (Selesai vs Dalam Proses)
- **Bar chart**: Hasil panen per farm
- **Statistik**:
  - Total panen selesai
  - Total panen dalam proses
  - Total hasil panen (ton)
- **Tabel riwayat**: Detail semua data panen
- **Form input panen**: Petani bisa input data panen mereka sendiri

### 3. 💧 Monitoring Penggunaan Air
- **Bar chart**: Penggunaan air per farm
- **Line chart**: Tren penggunaan air harian
- **Statistik**:
  - Total penggunaan air (liter)
  - Total biaya air
  - Rata-rata penggunaan per hari
- **Tabel riwayat**: Detail penggunaan air dengan sumber dan metode irigasi
- **Form input air**: Petani bisa catat penggunaan air mereka

### 4. 🧪 Monitoring Biaya Pupuk
- **Horizontal bar chart**: Biaya pupuk per farm
- **Pie chart**: Breakdown jenis pupuk
- **Statistik**:
  - Total biaya pupuk
  - Total kuantitas pupuk (kg)
  - Rata-rata biaya per farm
- **Tabel riwayat**: Detail penggunaan pupuk dengan jenis dan metode aplikasi
- **Form input pupuk**: Petani bisa input data pupuk mereka

## 🚀 Cara Menggunakan

### Akses Monitoring Dashboard
1. Login ke sistem
2. Dari dashboard utama, klik tombol **"📊 Lihat Dashboard Monitoring Lengkap"**
3. Atau akses langsung di: `/monitoring`

### Input Data Panen
1. Buka halaman monitoring (`/monitoring`)
2. Tab **🌾 Status Panen** → klik **"+ Input Data Panen"**
3. Isi form:
   - Pilih lahan
   - Jenis tanaman
   - Tanggal tanam
   - Perkiraan tanggal panen
   - Target hasil panen
   - Hasil panen aktual (opsional)
   - Status (Dalam Proses/Selesai)
   - Catatan (opsional)
4. Klik **"💾 Simpan Data Panen"**

### Input Data Penggunaan Air
1. Buka halaman monitoring (`/monitoring`)
2. Tab **💧 Penggunaan Air** → klik **"+ Input Data Air"**
3. Isi form:
   - Pilih lahan
   - Tanggal
   - Jumlah air (liter)
   - Sumber air (Sumur/PDAM/Sungai/dll)
   - Metode irigasi (Sprinkler/Drip/Manual/dll)
   - Biaya air
   - Catatan (opsional)
4. Klik **"💾 Simpan Data Air"**

### Input Data Penggunaan Pupuk
1. Buka halaman monitoring (`/monitoring`)
2. Tab **🧪 Biaya Pupuk** → klik **"+ Input Data Pupuk"**
3. Isi form:
   - Pilih lahan
   - Tanggal
   - Jenis pupuk (Urea/NPK/TSP/ZA/Organik/dll)
   - Kuantitas + satuan
   - Biaya pupuk
   - Metode aplikasi (Sebar/Tugal/Semprot/dll)
   - Catatan (opsional)
4. Klik **"💾 Simpan Data Pupuk"**

## 📍 Routes

### Halaman Monitoring
- **GET** `/monitoring` - Dashboard monitoring utama dengan 4 tab

### Form Input
- **GET** `/harvest-input` - Form input data panen
- **POST** `/harvest-input` - Simpan data panen
- **GET** `/water-input` - Form input penggunaan air
- **POST** `/water-input` - Simpan data air
- **GET** `/fertilizer-input` - Form input penggunaan pupuk
- **POST** `/fertilizer-input` - Simpan data pupuk

## 🎨 Teknologi

### Frontend
- **Tailwind CSS**: Styling responsif dan modern
- **Chart.js**: Visualisasi data dengan grafik interaktif
- **Blade Templates**: Template engine Laravel

### Backend
- **Laravel 11**: Framework PHP
- **MonitoringController**: Handle semua logic monitoring dan input data
- **Eloquent ORM**: Query database dengan relasi antar model

## 🔒 Keamanan

- **Authentication**: Semua route dilindungi dengan middleware `auth`
- **Authorization**: Petani hanya bisa input/lihat data dari farm mereka sendiri
- **Validation**: Input divalidasi untuk mencegah data invalid
- **CSRF Protection**: Token CSRF otomatis di semua form

## 📊 Struktur Data

### HarvestData (Hasil Panen)
- farm_id, crop_type, planting_date
- estimated_harvest_date, actual_harvest_date
- estimated_yield, actual_yield, yield_unit
- production_cost, status, notes

### WaterUsage (Penggunaan Air)
- farm_id, date, water_amount
- water_source, irrigation_method
- water_cost, notes

### FertilizerUsage (Penggunaan Pupuk)
- farm_id, date, fertilizer_type
- quantity, unit, fertilizer_cost
- application_method, notes

### WeatherData (Data Cuaca)
- farm_id, date
- temperature_max, temperature_min
- humidity, rainfall, wind_speed
- weather_condition

## 🎯 Fitur Tambahan

### Tab Navigation
- Interface tab yang user-friendly untuk switch antar monitoring
- Active state yang jelas
- Color-coded: hijau (suhu), kuning (panen), biru (air), merah (pupuk)

### Responsive Design
- Mobile-friendly
- Grid layout yang adaptif
- Touch-friendly buttons

### Feedback User
- Success notification setelah input data
- Error messages yang jelas
- Form validation real-time

## 🔄 Integrasi dengan Dashboard

Dashboard utama sekarang memiliki:
1. **4 chart preview**: Suhu, Panen, Air, Pupuk
2. **Link besar** ke monitoring lengkap
3. **Quick stats cards** untuk overview cepat

## 📈 Benefit untuk Petani

1. **Visualisasi Jelas**: Memahami data dengan mudah melalui grafik
2. **Input Mudah**: Form yang sederhana dan intuitif
3. **Tracking Lengkap**: Monitor semua aspek pertanian di satu tempat
4. **Data-Driven Decision**: Membuat keputusan berdasarkan data historis
5. **Cost Monitoring**: Pantau biaya air dan pupuk per farm
6. **Yield Tracking**: Bandingkan target vs hasil panen aktual

## 🛠️ Maintenance

### Update Data
- Data otomatis ter-update di grafik saat input baru
- Reload halaman untuk melihat perubahan

### Database
- Data tersimpan di 4 tabel utama (WeatherData, HarvestData, WaterUsage, FertilizerUsage)
- Relasi belongsTo dengan Farm model

## 🚦 Status Implementasi

✅ Monitoring dashboard dengan 4 tab
✅ Grafik interaktif dengan Chart.js
✅ Form input untuk panen, air, dan pupuk
✅ Controller dengan validasi
✅ Routes terintegrasi
✅ Security dengan auth & authorization
✅ Responsive design
✅ Link dari dashboard utama

## 📱 Screenshot Features

### Monitoring Dashboard
- 4 tabs: Suhu | Panen | Air | Pupuk
- Masing-masing tab punya:
  - 3 statistik cards
  - 2 grafik/chart
  - 1 tabel detail
  - 1 button input

### Form Input
- Clean design dengan gradient header
- Organized fields dengan icons
- Dropdown untuk pilihan
- Date picker untuk tanggal
- Validation messages
- Save & Cancel buttons

## 🎉 Kesimpulan

Sistem monitoring ini memberikan solusi lengkap untuk petani mengelola dan memantau:
- 📊 Kondisi cuaca & suhu
- 🌾 Hasil panen & produktivitas
- 💧 Penggunaan air & efisiensi irigasi
- 🧪 Biaya pupuk & pengeluaran

Semua dalam satu dashboard yang mudah digunakan dengan kemampuan input data langsung oleh petani!
