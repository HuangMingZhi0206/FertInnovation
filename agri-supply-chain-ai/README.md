# FertInnovation - AI-Driven Agri Supply Chain

Sistem manajemen rantai pasok pertanian berbasis AI yang komprehensif untuk optimalisasi pertanian modern.

## 🎯 Deskripsi Project

FertInnovation adalah aplikasi web Laravel yang dirancang untuk membantu petani dan stakeholder pertanian dalam:

1. **Monitoring & Dashboard** - Pantau semua data pertanian dalam satu dashboard terpadu
2. **Data Cuaca Real-time** - Informasi cuaca akurat untuk perencanaan tanam
3. **Harga Pasar Terkini** - Monitor harga produk di berbagai pasar
4. **Manajemen Hasil Panen** - Rencana dan catat hasil panen Anda
5. **Efisiensi Air** - Kelola penggunaan air untuk mengurangi biaya & limbah
6. **Manajemen Pupuk** - Aplikasi pupuk optimal untuk hasil maksimal
7. **AI ChatBot** - Konsultasi pertanian berbasis AI 24/7

## 🚀 Fitur Utama

### Dashboard
- Statistik lahan (total area, jumlah sawah/kebun)
- Data cuaca hari ini
- Status hasil panen
- Total biaya operasional
- Akses cepat ke semua fitur

### Monitoring
- **Cuaca**: Data suhu, kelembaban, curah hujan, kecepatan angin
- **Harga Pasar**: Harga produk di berbagai lokasi pasar
- **Hasil Panen**: Perencanaan dan pencatatan hasil panen
- **Air**: Penggunaan air dan biaya irigasi
- **Pupuk**: Jenis, jumlah, metode aplikasi pupuk

### Manajemen Lahan
- Tambah/edit/hapus lahan pertanian
- Informasi lokasi, luas, jenis tanaman, tipe tanah

### ChatBot AI
- Konsultasi pertanian 24/7
- Saran teknik tanam
- Analisis harga pasar
- Rekomendasi manajemen air & pupuk
- Quick questions untuk pertanyaan umum

## 💻 Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP Framework)
- **Database**: SQLite / MySQL
- **Frontend**: Blade Template Engine dengan Tailwind CSS
- **Bootstrap**: Bootstrap 5.3 untuk UI responsif
- **Authentication**: Laravel Breeze

## 📋 Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM (untuk asset building)
- SQLite atau MySQL

## ⚙️ Instalasi & Setup

### 1. Clone Repository
```bash
cd /home/kevinsyonin/Documents/Kode\ Program/FertInnovation
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Migration & Seeding
```bash
php artisan migrate:fresh --seed
```

### 5. Build Assets
```bash
npm run build
```

### 6. Jalankan Server
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Akses aplikasi di: http://localhost:8000

## 👥 Test Account

Email: `petani@example.com`
Password: `password123`

Email: `petani2@example.com`
Password: `password123`

## 📁 Struktur Database

### Tabel Utama

#### users
- id, name, email, password, email_verified_at, created_at, updated_at

#### farms
- id, user_id, name, location, area, crop_type, soil_type, created_at, updated_at

#### weather_data
- id, farm_id, date, temperature_max, temperature_min, humidity, rainfall, wind_speed, weather_condition, created_at, updated_at

#### market_prices
- id, product_name, market_location, price_per_unit, unit, date, demand_level, trend, created_at, updated_at

#### harvest_data
- id, farm_id, crop_type, planting_date, estimated_harvest_date, actual_harvest_date, estimated_yield, actual_yield, yield_unit, production_cost, status, notes, created_at, updated_at

#### water_usages
- id, farm_id, date, water_amount, water_source, irrigation_method, water_cost, notes, created_at, updated_at

#### fertilizer_usages
- id, farm_id, date, fertilizer_type, quantity, unit, fertilizer_cost, application_method, notes, created_at, updated_at

## 🔗 Routes & API

### Public Routes
- `/` - Halaman utama
- `/login` - Login page
- `/register` - Registrasi user baru

### Protected Routes (Authenticated)
- `/dashboard` - Dashboard utama
- `/farms` - Manajemen lahan
  - `GET /farms` - List lahan
  - `POST /farms` - Buat lahan
  - `GET /farms/{id}` - Detail lahan
  - `PATCH /farms/{id}` - Update lahan
  - `DELETE /farms/{id}` - Hapus lahan
- `/weather` - Monitoring cuaca
- `/market-prices` - Harga pasar
- `/harvest` - Data panen
- `/water-management` - Manajemen air
- `/fertilizer-management` - Manajemen pupuk
- `/chatbot` - AI ChatBot

## 📊 Sample Data

Database sudah berisi sample data:

**Users:**
- Petani Maju (2 lahan: Sawah Subur & Kebun Jagung)
- Petani Makmur (1 lahan: Lahan Subak)

**Data Per Lahan:**
- 8 hari data cuaca terakhir
- 2 riwayat hasil panen (1 sedang proses, 1 selesai)
- 24 harga pasar produk berbeda
- 10 pencatatan penggunaan air
- 15 pencatatan penggunaan pupuk

## 🤖 AI ChatBot Features

ChatBot dapat menjawab pertanyaan tentang:

- **Teknik Tanam**: Waktu tanam, persiapan lahan, varietas unggul
- **Manajemen Air**: Efisiensi irigasi, sumber air, metode penyiraman
- **Manajemen Pupuk**: Jenis pupuk, dosis, metode aplikasi
- **Harga Pasar**: Analisis trend harga, waktu penjualan optimal
- **Cuaca & Iklim**: Dampak cuaca pada tanaman, perencanaan
- **Hasil Panen**: Optimasi hasil, pencegahan penyakit

## 🎨 UI/UX Design

- **Responsif**: Mobile-friendly design untuk semua device
- **Intuitif**: Interface yang mudah dipahami
- **Dashboard Analytics**: Visualisasi data yang jelas
- **Real-time Updates**: Data yang selalu terbaru
- **Dark & Light Mode Compatible**: Sesuai preferensi pengguna

## 📈 Fitur AI Prediction (Future)

- Prediksi hasil panen berdasarkan kondisi lahan & cuaca
- Rekomendasi waktu tanam optimal
- Forecasting harga pasar
- Alert sistem untuk kondisi cuaca ekstrem
- Saran manajemen air & pupuk berbasis AI

## 🔐 Security

- CSRF Protection
- SQL Injection Prevention
- XSS Protection
- Password Hashing (bcrypt)
- Role-based Access Control

## 📱 Mobile Responsive

- Optimized untuk semua ukuran layar
- Touch-friendly interface
- Fast loading time
- Offline capability (future)

## �� Troubleshooting

### Port sudah dipakai
```bash
php artisan serve --host=127.0.0.1 --port=8001
```

### Database error
```bash
php artisan migrate:fresh --seed
php artisan db:seed --class=DatabaseSeeder
```

### Assets tidak load
```bash
npm run build
php artisan serve
```

## 📞 Support

Untuk bantuan atau pertanyaan:
- Email: support@fertinnovation.com
- Forum: community.fertinnovation.com

## 📄 License

MIT License - Free to use for educational and commercial purposes

## 👨‍💼 Pengembang

FertInnovation dikembangkan dengan fokus pada:
- Kemudahan penggunaan
- Akurasi data
- Skalabilitas
- Keberlanjutan pertanian

## 🎓 Disclaimer

FertInnovation adalah aplikasi edukasi dan manajemen. Keputusan pertanian final tetap menjadi tanggung jawab pengguna. Selalu konsultasikan dengan ahli agronomi lokal untuk hasil terbaik.

---

**Version**: 1.0.0
**Last Updated**: November 20, 2025
