# 👨‍🌾 Panduan Penggunaan FertInnovation

## 📋 Daftar Isi

1. [Login & Registrasi](#login--registrasi)
2. [Dashboard](#dashboard)
3. [Manajemen Lahan](#manajemen-lahan)
4. [Monitoring Cuaca](#monitoring-cuaca)
5. [Harga Pasar](#harga-pasar)
6. [Manajemen Panen](#manajemen-panen)
7. [Penggunaan Air](#penggunaan-air)
8. [Penggunaan Pupuk](#penggunaan-pupuk)
9. [AI Chatbot](#ai-chatbot)

---

## 🔐 Login & Registrasi

### Akses Awal
1. Buka browser dan masuk ke: **http://localhost:8000**
2. Klik tombol **"Login"** di halaman welcome
3. Atau klik **"Register"** untuk membuat akun baru

### Login dengan Akun Demo
- **Email**: `petani@test.com`
- **Password**: `password`

### Cara Registrasi Akun Baru
1. Klik tombol **"Register"** di halaman login
2. Isi form dengan data berikut:
   - **Nama Lengkap** (misal: "Petani Sukses")
   - **Email** (misal: "petani@example.com")
   - **Password** (minimal 8 karakter)
   - **Konfirmasi Password** (harus sama)
3. Klik **"Register"**
4. Verifikasi email Anda (untuk mode production)
5. Login dengan akun baru Anda

### Logout
- Klik profil Anda di kanan atas (pojok kanan dashboard)
- Klik **"Logout"**

---

## 📊 Dashboard

Dashboard adalah halaman utama setelah login. Menampilkan ringkasan semua data pertanian Anda.

### Komponen Dashboard

#### 1️⃣ Statistik Utama (Stat Cards)
Empat kartu menampilkan ringkasan cepat:

| Kartu | Informasi | Keterangan |
|-------|-----------|-----------|
| **Total Lahan** | Jumlah farm | Berapa banyak lahan yang dikelola |
| **Total Area** | Luas keseluruhan (Ha) | Total luas dalam hektar |
| **Panen Aktif** | Jumlah panen berjalan | Berapa banyak panen sedang berlangsung |
| **Temp. Cuaca** | Suhu terkini (°C) | Suhu terakhir yang tercatat |

#### 2️⃣ Detail Cuaca
Menampilkan informasi cuaca terbaru untuk lahan Anda:
- **Suhu Max/Min** - Rentang suhu hari ini
- **Kelembaban** - Persentase kelembaban udara
- **Curah Hujan** - Estimasi hujan (mm)
- **Kecepatan Angin** - Kecepatan angin (km/h)
- **Kondisi Cuaca** - Deskripsi kondisi (Cerah/Mendung/Hujan)

#### 3️⃣ Penggunaan Air & Pupuk (Bulanan)
Ringkasan penggunaan bulan ini:
- **Air**: Total liter + Total biaya
- **Pupuk**: Total kg + Total biaya

#### 4️⃣ Quick Action Buttons
6 tombol akses cepat dengan warna berbeda:
- 🔵 **Cuaca** → Lihat detail cuaca
- 🟢 **Panen** → Kelola panen
- 🟡 **Harga** → Cek harga pasar
- 🟠 **Air** → Track penggunaan air
- 🔴 **Pupuk** → Track penggunaan pupuk
- 🟣 **Chatbot** → Tanya AI

#### 5️⃣ Sidebar Kanan
- **Harga Pasar Trending** - Produk dengan harga tertinggi
- **Daftar Lahan Saya** - List semua farms dengan link

---

## 🌾 Manajemen Lahan

Kelola data lahan (farm) pertanian Anda.

### Akses Menu
- Dashboard → Klik tombol **"Kelola Lahan"** atau
- Sidebar → Klik **"Lahan"**

### Tampilan Lahan
Lahan ditampilkan dalam format **grid card** dengan informasi:
- **Nama Lahan** - Judul lahan
- **Lokasi** - Alamat/desa lahan
- **Luas** - Ukuran lahan (hektar)
- **Jenis Tanaman** - Komoditas yang ditanam
- **Jenis Tanah** - Kategori tanah

### Operasi Lahan

#### ➕ Tambah Lahan Baru
1. Klik tombol **"+ Tambah Lahan Baru"** (warna biru)
2. Isi form:
   - **Nama Lahan**: Misal "Sawah Utama"
   - **Lokasi**: Misal "Desa Sukatani, Kab. Bandung"
   - **Luas Area (Ha)**: Misal 2.5
   - **Jenis Tanaman**: Pilih dari list (Padi, Jagung, Kedelai, dll)
   - **Jenis Tanah**: Pilih dari list (Liat, Pasir, Lempung, dll)
3. Klik **"Simpan Lahan"**
4. Lahan baru muncul di grid

#### ✏️ Edit Lahan
1. Pada card lahan, klik tombol **"Edit"** (kuning)
2. Ubah data yang diperlukan
3. Klik **"Update Lahan"**

#### 🗑️ Hapus Lahan
1. Pada card lahan, klik tombol **"Hapus"** (merah)
2. Konfirmasi penghapusan
3. ⚠️ **Perhatian**: Data lahan dan history akan terhapus!

---

## ☁️ Monitoring Cuaca

Pantau kondisi cuaca harian untuk lahan Anda.

### Akses Menu
- Dashboard → Klik **"Cuaca"** atau
- Navigation → **"Monitoring"** → **"Cuaca"**

### Tampilan Data Cuaca
Tabel dengan kolom:
| Kolom | Keterangan |
|-------|-----------|
| **Tanggal** | Tanggal pengamatan |
| **Lahan** | Nama lahan yang diamati |
| **Suhu Max** | Suhu maksimum (°C) |
| **Suhu Min** | Suhu minimum (°C) |
| **Kelembaban** | Kelembaban udara (%) |
| **Curah Hujan** | Estimasi hujan (mm) |
| **Kondisi** | Deskripsi cuaca |

### Tambah Data Cuaca Manual
1. Klik tombol **"+ Input Cuaca Baru"** (biru)
2. Isi form:
   - **Pilih Lahan**: Lahan mana yang diamati
   - **Tanggal**: Tanggal pengamatan
   - **Suhu Maksimum**: Suhu tertinggi (°C)
   - **Suhu Minimum**: Suhu terendah (°C)
   - **Kelembaban**: Persentase kelembaban
   - **Curah Hujan**: Estimasi hujan (mm)
   - **Kondisi Cuaca**: Pilih (Cerah, Mendung, Hujan, Hujan Lebat)
3. Klik **"Simpan Data Cuaca"**

### Fitur Lanjutan
- **Filter Lahan**: Pilih lahan tertentu untuk melihat data spesifik
- **Urutkan**: Klik header kolom untuk sort ascending/descending
- **Pagination**: Navigasi data dengan tombol di bawah tabel

---

## 💰 Harga Pasar

Pantau harga pasar untuk produk pertanian.

### Akses Menu
- Dashboard → Klik **"Harga"** atau
- Navigation → **"Market"** → **"Harga Pasar"**

### Tampilan Harga
Grid card menampilkan:
- **Produk** - Nama komoditas (Padi, Jagung, Kedelai, dll)
- **Pasar/Lokasi** - Tempat harga berlaku
- **Harga/Unit** - Harga dalam rupiah
- **Unit** - Satuan (kg, ton, kuintal)
- **Tanggal** - Kapan harga terakhir update
- **Demand** - Level permintaan (1-10)
- **Trend** - Arah harga (↑ Naik, → Stabil)

### Filter & Pencarian
1. Gunakan dropdown **"Filter Produk"** untuk memilih komoditas
2. Card akan otomatis menyaring berdasarkan pilihan
3. Semua komoditas ditampilkan jika tidak ada filter

### Tips Menggunakan Harga Pasar
- 🟢 **Trend Naik**: Bagus untuk menjual
- 🟡 **Trend Stabil**: Pertahankan inventory
- 📊 **Demand Tinggi**: Peluang penjualan besar
- 💡 **Bandingkan Lokasi**: Pasar berbeda punya harga berbeda

---

## 🌱 Manajemen Panen

Rencanakan dan monitor hasil panen.

### Akses Menu
- Dashboard → Klik **"Panen"** atau
- Navigation → **"Management"** → **"Panen"**

### Tampilan Panen
Tabel dengan kolom:
| Kolom | Keterangan |
|-------|-----------|
| **Lahan** | Lahan yang dipanen |
| **Jenis Tanaman** | Komoditas yang ditanam |
| **Tgl Tanam** | Kapan ditanam |
| **Tgl Panen Est** | Estimasi waktu panen |
| **Status** | Dalam Proses / Selesai |
| **Est. Hasil** | Estimasi hasil (ton) |
| **Hasil Aktual** | Hasil sebenarnya (kosong jika belum selesai) |

### Tambah Rencana Panen
1. Klik **"+ Rencana Panen Baru"**
2. Isi form:
   - **Pilih Lahan**: Lahan mana yang akan dipanen
   - **Tanggal Tanam**: Kapan ditanam
   - **Est. Tanggal Panen**: Perkiraan panen (biasanya 3-4 bulan kemudian)
   - **Est. Hasil Panen**: Estimasi hasil (ton)
   - **Biaya Produksi**: Investasi (Rp)
3. Klik **"Simpan Panen"**

### Update Hasil Panen Aktual
1. Cari panen Anda di tabel
2. Klik tombol **"Detail/Edit"**
3. Ubah status menjadi **"Selesai"**
4. Masukkan **"Hasil Aktual"** (ton)
5. Klik **"Update"**

### Analisis Panen
- Bandingkan hasil estimasi vs aktual
- Hitung ROI: (Hasil Aktual × Harga Pasar) - Biaya Produksi

---

## 💧 Penggunaan Air

Track penggunaan air untuk irigasi dan analisis efisiensi.

### Akses Menu
- Dashboard → Klik **"Air"** atau
- Navigation → **"Resources"** → **"Air"**

### Tampilan Air
Dua bagian: **Ringkasan Bulanan** + **Tabel Detail**

#### Ringkasan Bulanan
Menampilkan untuk bulan ini:
- Total liter air
- Total biaya (Rp)
- Rata-rata harian
- Efisiensi dibanding bulan lalu

#### Tabel Detail
| Kolom | Keterangan |
|-------|-----------|
| **Tanggal** | Kapan air digunakan |
| **Lahan** | Lahan mana |
| **Jumlah Air** | Liter yang digunakan |
| **Sumber** | Sumur / Irigasi Persawahan |
| **Metode** | Sprinkler / Tetes / Genangan |
| **Biaya** | Biaya (Rp) |

### Tambah Data Air
1. Klik **"+ Input Air Baru"**
2. Isi form:
   - **Pilih Lahan**: Lahan mana yang diairi
   - **Tanggal**: Tanggal pemakaian
   - **Jumlah Air (liter)**: Berapa liter digunakan
   - **Sumber Air**: Pilih sumber
     - 🔵 **Sumur** - Air tanah dari sumur
     - 🟢 **Irigasi Persawahan** - Air dari sistem irigasi publik
   - **Metode Irigasi**: Pilih metode
     - 💧 **Sprinkler** - Penyemprotan
     - 🌧️ **Tetes** - Irigasi tetes/drip
     - 🌊 **Genangan** - Penggenangan sawah
   - **Biaya Air (Rp)**: Estimasi biaya
3. Klik **"Simpan Data Air"**

### Tips Efisiensi Air
- **Gunakan Irigasi Tetes**: Lebih hemat hingga 40%
- **Monitor Cuaca**: Kurangi air saat hujan
- **Pagi/Malam**: Irigasi pagi/malam lebih efisien
- **Jenis Tanah**: Tanah liat menyimpan air lebih lama

---

## 🌾 Penggunaan Pupuk

Monitor penggunaan pupuk dan kelola biaya.

### Akses Menu
- Dashboard → Klik **"Pupuk"** atau
- Navigation → **"Resources"** → **"Pupuk"**

### Tampilan Pupuk
Ringkasan bulanan + Tabel detail

#### Ringkasan Bulanan
- Total biaya pupuk bulan ini (Rp)
- Rata-rata per aplikasi
- Trend konsumsi

#### Tabel Detail
| Kolom | Keterangan |
|-------|-----------|
| **Tanggal** | Kapan pupuk diberikan |
| **Lahan** | Lahan mana |
| **Jenis Pupuk** | Tipe pupuk yang digunakan |
| **Jumlah** | Kg yang digunakan |
| **Metode** | Sebar / Cair |
| **Biaya** | Biaya (Rp) |

### Jenis Pupuk Tersedia

| Pupuk | Keterangan | Harga (Rp/kg) |
|-------|-----------|--------------|
| **Urea** | Pupuk nitrogen tinggi | ~2,500 |
| **SP-36** | Pupuk fosfat untuk berbunga | ~6,500 |
| **KCl** | Pupuk kalium untuk ketahanan | ~5,500 |
| **NPK** | Pupuk lengkap (N+P+K) | ~4,500 |
| **Organik** | Pupuk kompos alami | ~3,000 |

### Tambah Data Pupuk
1. Klik **"+ Input Pupuk Baru"**
2. Isi form:
   - **Pilih Lahan**: Lahan mana yang dipupuk
   - **Tanggal**: Tanggal pemberian pupuk
   - **Jenis Pupuk**: Pilih dari list (Urea, SP-36, KCl, NPK, Organik)
   - **Jumlah (kg)**: Berapa kg digunakan
   - **Metode**: 
     - 📦 **Sebar** - Disebarkan langsung ke tanah
     - 💧 **Cair** - Dilarutkan dalam air
   - **Biaya Pupuk (Rp)**: Harga yang dibayarkan
3. Klik **"Simpan Data Pupuk"**

### Rekomendasi Pupuk

#### Padi
- **Urea**: 100-150 kg/ha (3-4 kali aplikasi)
- **SP-36**: 50-100 kg/ha (sekali saja)
- **KCl**: 50-75 kg/ha (2 kali aplikasi)

#### Jagung
- **Urea**: 150-200 kg/ha
- **SP-36**: 75-100 kg/ha
- **KCl**: 75-100 kg/ha

#### Waktu Aplikasi
- **Awal Pertumbuhan**: Urea + organik
- **Fase Bunga**: SP-36
- **Fase Buah**: KCl

---

## �� AI Chatbot

Dapatkan konsultasi pertanian dari AI.

### Akses Chatbot
- Dashboard → Klik **"Chatbot"** atau
- Navigation → **"Help"** → **"AI Chatbot"**

### Interface Chatbot
- **Area Chat**: Tampilan pesan percakapan
- **Input Box**: Tempat mengetik pertanyaan
- **Suggestion Buttons**: Tombol quick questions

### Cara Menggunakan
1. **Metode 1 - Ketik Pertanyaan**:
   - Klik kotak input di bawah
   - Ketik pertanyaan Anda (misal: "Bagaimana cara hemat air?")
   - Tekan Enter atau klik tombol **"Kirim"**
   - AI akan menjawab dalam bahasa Indonesia

2. **Metode 2 - Gunakan Suggestion**:
   - Klik salah satu tombol saran di bawah
   - AI langsung memberikan jawaban

### Topik yang Bisa Ditanyakan

#### 🌤️ Cuaca (Ketik "cuaca")
- Cara menghadapi cuaca ekstrem
- Tips tanam saat musim hujan
- Antisipasi kekeringan

#### 🌾 Pupuk (Ketik "pupuk")
- Efisiensi penggunaan pupuk
- Pemilihan jenis pupuk
- Cara aplikasi tepat waktu

#### 💧 Air (Ketik "air")
- Efisiensi penggunaan air
- Sistem irigasi terbaik
- Tips hemat air

#### 🌽 Panen (Ketik "panen")
- Optimalisasi hasil panen
- Waktu panen yang tepat
- Cara penyimpanan hasil

#### 💰 Harga (Ketik "harga")
- Strategi pemasaran
- Kapan waktu terbaik jual
- Tips negosiasi harga

### Contoh Percakapan

**User**: "Bagaimana cara efisien air untuk padi?"
**Bot**: "Untuk efisiensi air pada padi, saya rekomendasikan..."

**User**: "pupuk apa terbaik untuk jagung?"
**Bot**: "Untuk jagung, gunakan kombinasi..."

### Catatan
- ℹ️ AI berbasis keyword - jawaban general untuk topik
- 🔄 Semua chat disimpan untuk improvement
- 🌐 Bahasa: Indonesian (Bahasa Indonesia)

---

## 📈 Dashboard Analysis Tips

### Merencanakan Musim Tanam
1. Lihat **Harga Pasar** → cari produk dengan harga tinggi
2. Lihat **Data Cuaca** → pilih musim dengan cuaca stabil
3. Buat **Rencana Panen** untuk 3-4 bulan kemudian
4. Persiapkan **Budget Pupuk & Air**

### Optimasi Biaya
1. Track **Penggunaan Air** bulan ke bulan
2. Track **Penggunaan Pupuk** dan compare harga
3. Lihat **Detail Panen** → hitung ROI aktual
4. Adjust strategi berdasarkan data

### Monitoring Kesehatan Lahan
1. Check **Data Cuaca** regular → antisipasi perubahan
2. Monitor **Hasil Panen** → identifikasi masalah
3. Compare **Efisiensi Air** → jika naik, ada pemborosan
4. Tanya **AI Chatbot** untuk rekomendasi

---

## 🆘 FAQ & Troubleshooting

### Q: Lupa password?
**A**: Klik "Forgot Password" di halaman login, isi email, ikuti instruksi reset

### Q: Data tidak muncul di dashboard?
**A**: 
- Refresh halaman (F5)
- Clear browser cache
- Login kembali
- Cek apakah sudah ada data (add lahan/cuaca terlebih dahulu)

### Q: Error saat tambah data?
**A**:
- Periksa form sudah lengkap semua
- Periksa format angka (jangan ada huruf)
- Cek error message untuk detail

### Q: Bagaimana hapus akun?
**A**: Hubungi admin atau support - fitur delete account di planning

### Q: Bisa backup data?
**A**: Data tersimpan di database - contact admin untuk backup

### Q: Aplikasi lambat?
**A**:
- Refresh halaman
- Clear cache browser
- Restart server
- Check koneksi internet

---

## 📞 Support

- 📧 Email: support@fertinnovation.com
- 📱 WhatsApp: [Coming Soon]
- 🌐 Website: www.fertinnovation.com
- 🐛 Report Bug: Create issue di repository

---

**Last Updated**: November 2025
**Version**: 1.0
**Language**: Bahasa Indonesia / English

Selamat menggunakan FertInnovation! 🌾🚀
