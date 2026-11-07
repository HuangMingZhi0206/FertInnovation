# 📖 Panduan Instalasi FertInnovation

## 🎯 Persyaratan Sistem

Sebelum menginstal, pastikan sistem Anda memenuhi persyaratan berikut:

### Minimum Requirements
- **OS**: Linux, macOS, atau Windows
- **PHP**: 8.3 atau lebih tinggi
- **Composer**: 2.0 atau lebih tinggi
- **Node.js**: 18+ dan npm
- **Database**: SQLite, MySQL 5.7+, atau PostgreSQL 10+

### Check Persyaratan
```bash
php -v                    # Check PHP version
composer --version        # Check Composer
node -v && npm -v        # Check Node.js and npm
```

## 📥 Instalasi Langkah Demi Langkah

### 1️⃣ Download/Clone Project

```bash
# Navigate to workspace
cd "/home/kevinsyonin/Documents/Kode Program/FertInnovation"

# Project sudah ada di: agri-supply-chain-ai/
cd agri-supply-chain-ai
```

### 2️⃣ Install PHP Dependencies

```bash
composer install
```

Proses ini akan menginstall semua paket PHP yang diperlukan, termasuk:
- Laravel Framework
- Laravel Breeze
- Eloquent ORM
- dan dependencies lainnya

**Durasi**: 2-5 menit tergantung koneksi internet

### 3️⃣ Setup Environment File

```bash
# Copy .env.example ke .env
cp .env.example .env

# Generate Application Key
php artisan key:generate
```

Periksa file `.env` dan pastikan konfigurasi database sudah benar:

```env
# Untuk SQLite (Default)
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# ATAU untuk MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agri_supply_chain
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Setup Database

```bash
# Jalankan migrations
php artisan migrate:fresh

# Seed database dengan sample data
php artisan db:seed
```

Perintah ini akan:
- ✅ Membuat semua tabel database
- ✅ Membuat 1 user demo (petani@test.com)
- ✅ Generate 2 farms dengan data lengkap
- ✅ Membuat 30 hari data cuaca
- ✅ Generate harga pasar dari berbagai lokasi
- ✅ Membuat sample data air dan pupuk

### 5️⃣ Install NPM Dependencies

```bash
npm install
```

### 6️⃣ Build Frontend Assets

```bash
# Development build (dengan watch mode)
npm run dev

# ATAU Production build (optimized)
npm run build
```

### 7️⃣ Jalankan Development Server

Buka terminal baru dan jalankan:

```bash
php artisan serve
```

Server akan berjalan di: **http://localhost:8000**

## 🚀 Akses Aplikasi

### Login Credentials

Gunakan akun demo untuk testing:
- **Email**: `petani@test.com`
- **Password**: `password`

### Navigate
1. Buka browser: http://localhost:8000
2. Klik "Login"
3. Masukkan credentials di atas
4. Selamat datang di Dashboard! 🎉

## 🎨 Fitur yang Siap Digunakan

Setelah login, Anda bisa langsung menggunakan:

✅ **Dashboard** - Overview statistik pertanian
✅ **Manajemen Lahan** - CRUD farms
✅ **Monitoring Cuaca** - 30 hari data cuaca
✅ **Harga Pasar** - Data harga real-time
✅ **Manajemen Panen** - Planning & tracking
✅ **Penggunaan Air** - Tracking & cost analysis
✅ **Penggunaan Pupuk** - Tracking & recommendations
✅ **AI Chatbot** - Konsultasi pertanian

## 🔧 Konfigurasi Lanjutan

### Ubah Database ke MySQL (Optional)

1. **Create Database**
```bash
mysql -u root -p
CREATE DATABASE agri_supply_chain;
CREATE USER 'agri_user'@'localhost' IDENTIFIED BY 'agri_password';
GRANT ALL PRIVILEGES ON agri_supply_chain.* TO 'agri_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

2. **Update .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agri_supply_chain
DB_USERNAME=agri_user
DB_PASSWORD=agri_password
```

3. **Run Migrations**
```bash
php artisan migrate:fresh --seed
```

### Generate Test User

Jika ingin membuat user baru:

```bash
php artisan tinker
>>> App\Models\User::create(['name' => 'John Farmer', 'email' => 'john@example.com', 'password' => bcrypt('password')])
>>> exit
```

## 📦 Project Structure Quick Reference

```
agri-supply-chain-ai/
├── app/
│   ├── Http/Controllers/      ← Business Logic
│   └── Models/                ← Database Models
├── database/
│   ├── migrations/            ← Table Definitions
│   └── seeders/               ← Sample Data
├── resources/
│   └── views/                 ← UI Templates (Blade)
├── routes/
│   └── web.php                ← URL Routes
├── public/                    ← Static Assets
├── storage/                   ← Logs & Cache
└── .env                       ← Configuration
```

## �� Troubleshooting

### Problem: "Class not found" Error

**Solution:**
```bash
composer dump-autoload
php artisan cache:clear
```

### Problem: "Connection refused" MySQL

**Solution:**
```bash
# Pastikan MySQL running
sudo service mysql start

# Check status
sudo service mysql status
```

### Problem: Port 8000 already in use

**Solution:**
```bash
# Gunakan port lain
php artisan serve --port=8001

# Atau find process using port 8000
lsof -i :8000
kill -9 <PID>
```

### Problem: Permission denied on storage/

**Solution:**
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Problem: Database locked (SQLite)

**Solution:**
```bash
# Delete database dan re-migrate
rm database/database.sqlite
php artisan migrate:fresh --seed
```

## 📝 Commands Cheat Sheet

### Development
```bash
php artisan serve                    # Start dev server
npm run dev                          # Watch frontend changes
php artisan tinker                   # Interactive shell
php artisan config:cache             # Cache config
php artisan view:cache               # Cache views
```

### Database
```bash
php artisan migrate                  # Run migrations
php artisan migrate:rollback         # Rollback migrations
php artisan migrate:fresh            # Reset database
php artisan migrate:refresh --seed   # Reset & seed
php artisan db:seed                  # Seed database
php artisan db:seed --class=CustomSeeder  # Seed specific class
```

### Artisan Generators
```bash
php artisan make:controller ControllerName
php artisan make:model ModelName -m  # with migration
php artisan make:migration migration_name
php artisan make:seeder SeederName
```

### Maintenance
```bash
php artisan cache:clear              # Clear cache
php artisan config:clear             # Clear config cache
php artisan view:clear               # Clear view cache
php artisan route:cache              # Cache routes
php artisan route:clear              # Clear route cache
php artisan storage:link             # Link storage
```

## 🌐 Deployment (Production)

### Pre-deployment Checklist
```bash
# 1. Update dependencies
composer update

# 2. Build frontend
npm run build

# 3. Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Optimize autoloader
composer install --optimize-autoloader --no-dev

# 5. Set permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/

# 6. Update .env
# Change APP_ENV=production
# Change APP_DEBUG=false
```

### Deploy Commands
```bash
# Via FTP/SSH
git pull origin main
composer install --no-dev
npm install && npm run build
php artisan migrate --force
php artisan config:cache
```

## 📞 Support & Debugging

### Enable Debug Mode
```env
APP_DEBUG=true
APP_LOG_LEVEL=debug
```

### View Logs
```bash
tail -f storage/logs/laravel.log
```

### Laravel Logs Location
```
storage/logs/laravel.log
storage/logs/laravel-2025-11-20.log
```

## ✅ Post-Installation Verification

Verify installation berhasil:

```bash
# Test database connection
php artisan db:show

# Test migrations status
php artisan migrate:status

# Verify routes
php artisan route:list

# Check system requirements
php artisan about
```

## 🎓 Learning Resources

- Laravel Documentation: https://laravel.com/docs
- Blade Templating: https://laravel.com/docs/blade
- Eloquent ORM: https://laravel.com/docs/eloquent
- Tailwind CSS: https://tailwindcss.com/docs
- Laravel Breeze: https://laravel.com/docs/starter-kits#breeze

## 🎉 Success!

Jika Anda berhasil mencapai tahap ini:

✅ PHP & Composer terinstall
✅ Project files siap
✅ Database configured
✅ Frontend assets built
✅ Server running
✅ Aplikasi accessible

**Selamat! FertInnovation siap digunakan!** 🌾

---

**Terakhir diupdate**: November 2025
**Questions?** Lihat README.md atau buka issue di repository
