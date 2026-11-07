# Quick Start Guide - FertInnovation

Panduan cepat untuk mulai menggunakan FertInnovation dalam 5 menit.

## 🚀 Start Aplikasi

### 1. Terminal 1 - Jalankan Server Laravel
```bash
cd "/home/kevinsyonin/Documents/Kode Program/FertInnovation/agri-supply-chain-ai"
php artisan serve --host=127.0.0.1 --port=8000
```

### 2. Buka Browser
```
http://localhost:8000
```

## 📝 Login

**Email**: petani@example.com
**Password**: password123

Atau daftar akun baru dengan menu "Register"

## 🎯 Fitur-Fitur Utama

### 1. Dashboard (/)
- Ringkasan data pertanian Anda
- Statistik lahan & hasil panen
- Data cuaca terkini
- Harga pasar terbaru

### 2. Manajemen Lahan (/farms)
- Lihat semua lahan Anda
- Tambah lahan baru
- Edit informasi lahan
- Hapus lahan

### 3. Monitoring Cuaca (/weather)
- Data suhu min/max
- Kelembaban udara
- Curah hujan
- Kecepatan angin

### 4. Harga Pasar (/market-prices)
- Harga produk di berbagai pasar
- Trend harga (naik/turun/stabil)
- Level permintaan
- Update real-time

### 5. Data Panen (/harvest)
- Rencana penanaman
- Estimasi hasil panen
- Tracking status panen
- Riwayat panen

### 6. Manajemen Air (/water-management)
- Penggunaan air harian
- Sumber air yang digunakan
- Biaya air
- Metode irigasi

### 7. Manajemen Pupuk (/fertilizer-management)
- Jenis pupuk yang digunakan
- Jumlah aplikasi
- Biaya pupuk
- Efisiensi penggunaan

### 8. AI ChatBot (/chatbot)
- Tanyakan pertanyaan seputar pertanian
- Dapatkan saran dari AI
- Quick questions untuk topik populer
- 24/7 tersedia

## 💡 Tips & Trik

### Login dengan Akun Berbeda
- **Petani Maju**: petani@example.com (2 lahan)
- **Petani Makmur**: petani2@example.com (1 lahan)

### Sample Data
Aplikasi sudah dilengkapi dengan sample data:
- 3 lahan pertanian
- 8 hari data cuaca
- 24 harga pasar produk
- 2 riwayat hasil panen
- 10 pencatatan air
- 15 pencatatan pupuk

### Gunakan ChatBot untuk Bantuan
- Tanya: "Kapan waktu tanam padi?"
- Tanya: "Bagaimana hemat air?"
- Tanya: "Berapa harga padi?"

## ⚠️ Troubleshooting

**Port 8000 sudah dipakai?**
```bash
php artisan serve --host=127.0.0.1 --port=8001
```

**Database error?**
```bash
php artisan migrate:fresh --seed
```

**Assets tidak muncul?**
```bash
npm run build
php artisan serve
```

## 🔗 Dokumentasi Lengkap

Lihat file `README.md` untuk dokumentasi lengkap.

## ✨ Fitur Selanjutnya

- Real API integration untuk cuaca & harga pasar
- Advanced AI predictions
- Mobile app native
- Export laporan PDF
- Multi-bahasa support

---

**Happy Farming! 🌾**
