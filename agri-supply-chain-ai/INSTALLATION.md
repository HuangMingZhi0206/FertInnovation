# Installation Guide - FertInnovation

Panduan instalasi lengkap FertInnovation dari awal hingga siap pakai.

## ✅ Prerequisites

Pastikan Anda telah menginstall:
- PHP >= 8.1
- Composer (PHP package manager)
- Node.js >= 18 dan NPM
- Git
- SQLite3 (biasanya sudah built-in di PHP) atau MySQL

### Verifikasi Installation

```bash
php --version          # Pastikan PHP >= 8.1
composer --version     # Verifikasi composer terinstall
node --version         # Pastikan Node >= 18
npm --version          # Verifikasi npm terinstall
```

## 📥 Step 1: Clone atau Extract Project

### Jika dari Git
```bash
git clone https://github.com/yourusername/fertinnovation.git
cd fertinnovation
```

### Jika dari ZIP
```bash
unzip agri-supply-chain-ai.zip
cd agri-supply-chain-ai
```

### Menggunakan path yang ada
```bash
cd "/home/kevinsyonin/Documents/Kode Program/FertInnovation/agri-supply-chain-ai"
```

## 🔧 Step 2: Install PHP Dependencies

```bash
composer install
```

Proses ini akan menginstall semua dependencies yang diperlukan seperti:
- Laravel Framework 12
- Database drivers
- Testing tools
- Development utilities

**Waktu**: ~2-5 menit tergantung koneksi internet

## 📦 Step 3: Install Node.js Dependencies

```bash
npm install
```

Ini akan menginstall:
- Bootstrap 5
- Tailwind CSS
- Build tools
- Development servers

**Waktu**: ~1-3 menit

## 🔐 Step 4: Setup Environment Variables

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi:

```env
APP_NAME=FertInnovation
APP_ENV=local
APP_KEY=    # Akan digenerasi di step berikutnya
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=sqlite
# Atau untuk MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=agri_supply_chain
# DB_USERNAME=root
# DB_PASSWORD=your_password
```

## 🔑 Step 5: Generate Application Key

```bash
php artisan key:generate
```

Output:
```
Application key set successfully.
```

## 🗄️ Step 6: Setup Database

### Menggunakan SQLite (Default - Recommended)

```bash
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder
```

### Menggunakan MySQL (Alternative)

1. Buat database:
```sql
CREATE DATABASE agri_supply_chain;
CREATE USER 'agri_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON agri_supply_chain.* TO 'agri_user'@'localhost';
FLUSH PRIVILEGES;
```

2. Update `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agri_supply_chain
DB_USERNAME=agri_user
DB_PASSWORD=secure_password
```

3. Jalankan migrations:
```bash
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder
```

## 🎨 Step 7: Build Frontend Assets

```bash
npm run build
```

Atau untuk development dengan auto-rebuild:
```bash
npm run dev
```

## 🚀 Step 8: Start Server

### Development Server

Terminal 1 - Jalankan Laravel Server:
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Output:
```
Laravel development server started on [http://127.0.0.1:8000]
```

### (Optional) Terminal 2 - Jalankan Vite Dev Server

```bash
npm run dev
```

## ✅ Step 9: Verify Installation

Buka browser dan akses:
```
http://localhost:8000
```

Anda seharusnya melihat halaman welcome FertInnovation.

## 📝 Step 10: Login dengan Test Account

Klik "Login" di navigation bar dan gunakan:

**Email**: petani@example.com
**Password**: password123

Atau daftar akun baru dengan "Register"

## ✨ Installation Complete!

Selamat! FertInnovation sudah siap digunakan. 🎉

## 🐛 Troubleshooting

### Error: "SQLSTATE[HY000]: General error: 1030"
```bash
rm database/database.sqlite
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder
```

### Error: "Port 8000 already in use"
```bash
php artisan serve --host=127.0.0.1 --port=8001
```

### Error: "Class not found"
```bash
composer dump-autoload
php artisan optimize:clear
```

### Error: "Assets not loading"
```bash
npm run build
npm run dev
```

### Database permission error
```bash
chmod 777 database/
chmod 777 database/database.sqlite
```

### Laravel cache issues
```bash
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📚 Next Steps

1. Baca `README.md` untuk overview project
2. Lihat `QUICK_START.md` untuk quick guide
3. Explore `FEATURES.md` untuk detail fitur
4. Test aplikasi dengan sample data yang sudah tersedia

## 🔗 Useful Commands

```bash
# Database
php artisan migrate               # Run migrations
php artisan migrate:rollback     # Undo last migration
php artisan migrate:fresh --seed # Fresh migration + seeding
php artisan db:seed              # Run seeders

# Cache & Config
php artisan optimize:clear       # Clear all caches
php artisan config:clear         # Clear config cache
php artisan cache:clear          # Clear cache

# Development
php artisan tinker               # Interactive PHP shell
php artisan make:model ModelName # Create new model
php artisan make:migration table_name # Create migration
php artisan make:controller ControllerName # Create controller

# Production
php artisan optimize             # Optimize application
php artisan config:cache         # Cache configuration
php artisan route:cache          # Cache routes
```

## 🔒 Security Checklist untuk Production

- [ ] Set `APP_DEBUG=false` di `.env`
- [ ] Generate strong `APP_KEY`
- [ ] Update database credentials
- [ ] Setup SSL/HTTPS
- [ ] Configure firewall rules
- [ ] Backup database regularly
- [ ] Enable CSRF protection
- [ ] Review authentication settings
- [ ] Monitor error logs
- [ ] Keep Laravel updated

## 📞 Support

Jika mengalami masalah:
1. Baca troubleshooting section di atas
2. Check Laravel documentation: https://laravel.com/docs
3. Check error logs: `storage/logs/`
4. Hubungi support: support@fertinnovation.com

---

**Happy Farming! 🌾**
