# ⚡ Quick Start - FertInnovation

## 🚀 5 Menit untuk Mulai

### Prerequisite Check
```bash
# Pastikan PHP, Composer, Node.js installed
php -v          # Should be 8.3+
composer -v     # Should be 2.0+
node -v && npm -v
```

### Step 1: Install & Setup (2 menit)
```bash
cd "/home/kevinsyonin/Documents/Kode Program/FertInnovation/agri-supply-chain-ai"
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run build
```

### Step 2: Setup Database (1 menit)
```bash
php artisan migrate:fresh --seed
```

### Step 3: Start Server (1 menit)
```bash
php artisan serve
# Server running at http://localhost:8000
```

### Step 4: Open & Login (1 menit)
```
URL: http://localhost:8000
Email: petani@test.com
Password: password
```

✅ **Done!** Sekarang Anda di Dashboard FertInnovation

---

## 📚 Main Features

| Feature | URL | Purpose |
|---------|-----|---------|
| 📊 Dashboard | `/dashboard` | Overview semua data |
| 🌾 Farms | `/farms` | Kelola lahan |
| ☁️ Weather | `/weather` | Monitor cuaca |
| 💰 Market Prices | `/market-prices` | Cek harga pasar |
| 🌱 Harvest | `/harvest` | Plan & track panen |
| 💧 Water Usage | `/water-usage` | Track air |
| 🌿 Fertilizer | `/fertilizer-usage` | Track pupuk |
| 🤖 Chatbot | `/chatbot` | AI konsultasi |

---

## 💡 Pro Tips

### For New Users
1. ✅ Lihat Dashboard dulu → understand interface
2. ✅ Tambah minimal 1 lahan (farm)
3. ✅ Explore semua fitur → fill sample data
4. ✅ Tanya Chatbot → learn recommendations

### For Developers
```bash
# Run with watch mode
npm run dev      # Terminal 1 - watch assets
php artisan serve  # Terminal 2 - run server

# Useful commands
php artisan tinker                    # Interactive shell
php artisan db:seed --class=CustomSeeder  # Re-seed data
php artisan make:controller NameController  # Generate controller
```

### Database
- **Default**: SQLite (database/database.sqlite)
- **Switch to MySQL**: Edit .env → run migrate:fresh --seed

---

## 🆘 Quick Troubleshooting

| Problem | Solution |
|---------|----------|
| Server not starting | Check port 8000 not in use: `lsof -i :8000` |
| "Class not found" | Run: `composer dump-autoload` |
| Database error | Run: `php artisan migrate:fresh --seed` |
| Assets not loading | Run: `npm run build` |
| Port 8000 busy | Use: `php artisan serve --port=8001` |

---

## 📖 Full Documentation

- **Installation**: `INSTALLATION_GUIDE.md`
- **User Guide**: `USER_GUIDE.md`
- **Project Structure**: `PROJECT_STRUCTURE.md`
- **README**: `README.md`

---

## 🎯 What's Next?

### For Testing
- ✅ Login with demo account
- ✅ Explore all pages
- ✅ Create new farm & add data
- ✅ Test chatbot queries

### For Customization
- Edit controllers in `app/Http/Controllers/`
- Modify views in `resources/views/`
- Update models in `app/Models/`
- Customize styles in `resources/css/app.css`

### For Production
- See `INSTALLATION_GUIDE.md` → **Deployment** section
- Switch to MySQL/PostgreSQL
- Configure HTTPS
- Set up backups

---

**Questions?** See full docs or open issue on GitHub

Happy Farming! 🌾
