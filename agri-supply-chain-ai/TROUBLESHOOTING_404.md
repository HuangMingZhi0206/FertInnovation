/..........................................................................................................# 🔧 Troubleshooting: Error 404 "Gagal mengambil data cuaca"

## ❌ Error yang Terjadi

```
Failed to load resource: the server responded with a status of 404 (Not Found)
Error: Gagal mengambil data cuaca
```

## 🔍 Penyebab Umum

### 1. **Route Tidak Ditemukan (404)**
- Route belum terdaftar
- Route salah nama
- Cache route lama

### 2. **Middleware Auth**
- User belum login
- Session expired
- CSRF token tidak valid

### 3. **Server Belum Jalan**
- Laravel development server mati
- Port berbeda

---

## ✅ Solusi yang Sudah Diterapkan

### 1. **Perbaikan JavaScript**

**Sebelum:**
```javascript
fetch(`/api/weather/location?lat=${lat}&lon=${lon}`)
```

**Sesudah:**
```javascript
const url = `{{ route('api.weather.location') }}?lat=${lat}&lon=${lon}`;
fetch(url, {
    method: 'GET',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    credentials: 'same-origin'
})
```

**Keuntungan:**
- ✅ Menggunakan Laravel route helper (URL benar)
- ✅ Error handling lebih detail
- ✅ Console.log untuk debugging
- ✅ CSRF token dengan fallback

### 2. **Clear Cache**

```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

### 3. **Test Page Dibuat**

File: `resources/views/test-weather-api.blade.php`

Akses di: `http://localhost:8000/test-weather-api`

---

## 🧪 Cara Testing

### Step 1: Pastikan Server Berjalan

```bash
php artisan serve
```

Output yang benar:
```
INFO  Server running on [http://127.0.0.1:8000].
```

### Step 2: Cek Route Terdaftar

```bash
php artisan route:list --name=api.weather
```

Output yang benar:
```
GET|HEAD  api/weather/location  api.weather.location › Api\WeatherApiController@getWeatherByLocation
```

### Step 3: Test dengan Test Page

1. Login ke aplikasi
2. Buka: `http://localhost:8000/test-weather-api`
3. Klik "Test Jakarta Coordinates"
4. Lihat hasil di halaman

### Step 4: Lihat Browser Console

1. Tekan `F12` di browser
2. Tab "Console"
3. Lihat output log:
   - "Fetching weather from: ..."
   - "Response status: 200"
   - "Weather data received: ..."

### Step 5: Lihat Network Tab

1. Tekan `F12` → Tab "Network"
2. Filter: "XHR" atau "Fetch"
3. Klik request ke `/api/weather/location`
4. Lihat:
   - Status Code: harus `200`
   - Response: harus ada JSON data

---

## 🐛 Debugging Steps

### 1. Check Browser Console

```javascript
// Seharusnya muncul:
Fetching weather from: http://localhost:8000/api/weather/location?lat=-6.1753&lon=106.8271
Response status: 200
Weather data received: { success: true, ... }
```

### 2. Check Laravel Logs

File: `storage/logs/laravel.log`

Cari error terbaru:
```bash
# Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 50
```

### 3. Test API Langsung

**Via Browser:**
```
http://localhost:8000/api/weather/location?lat=-6.1753&lon=106.8271
```

**Via PowerShell:**
```powershell
$session = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$cookie = New-Object System.Net.Cookie
$cookie.Name = "laravel_session"
$cookie.Value = "YOUR_SESSION_COOKIE"
$cookie.Domain = "localhost"
$session.Cookies.Add($cookie)

Invoke-WebRequest -Uri "http://localhost:8000/api/weather/location?lat=-6.1753&lon=106.8271" `
    -WebSession $session `
    -Headers @{"Accept"="application/json"}
```

### 4. Test Controller Langsung

```bash
php artisan tinker
```

Kemudian:
```php
$controller = new App\Http\Controllers\Api\WeatherApiController();
$request = new Illuminate\Http\Request(['lat' => -6.1753, 'lon' => 106.8271]);
$response = $controller->getWeatherByLocation($request);
echo $response->getContent();
```

---

## 📋 Checklist Troubleshooting

Gunakan checklist ini untuk memastikan semuanya bekerja:

- [ ] **Server berjalan**
  ```bash
  php artisan serve
  ```

- [ ] **Route terdaftar**
  ```bash
  php artisan route:list --name=api.weather
  ```

- [ ] **Cache sudah dibersihkan**
  ```bash
  php artisan cache:clear
  ```

- [ ] **User sudah login**
  - Login ke aplikasi dulu

- [ ] **CSRF token ada**
  - View source, cari `<meta name="csrf-token"`

- [ ] **Browser console tidak ada error**
  - F12 → Console → Tidak ada error merah

- [ ] **Network request berhasil**
  - F12 → Network → Status 200

- [ ] **Controller file ada**
  - `app/Http/Controllers/Api/WeatherApiController.php`

- [ ] **Route file benar**
  - `routes/web.php` → Ada route `api.weather.location`

---

## 💡 Tips Debugging

### 1. Gunakan Console.log

Dashboard sudah ditambahkan console.log:
```javascript
console.log('Fetching weather from:', url);
console.log('Response status:', response.status);
console.log('Weather data received:', data);
```

### 2. Test di Test Page Dulu

Sebelum test di dashboard, test di:
```
http://localhost:8000/test-weather-api
```

Ini memudahkan debugging karena:
- ✅ Tampilan lebih sederhana
- ✅ Response ditampilkan langsung
- ✅ Tombol terpisah untuk berbagai test case

### 3. Disable Cache Sementara

Tambahkan di `.env`:
```env
CACHE_DRIVER=array
SESSION_DRIVER=file
```

### 4. Enable Debug Mode

Di `.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

---

## 🔄 Langkah Perbaikan yang Dilakukan

### 1. ✅ Update JavaScript
- Gunakan Laravel route helper
- Tambah error handling detail
- Tambah console.log untuk debugging

### 2. ✅ Clear All Cache
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

### 3. ✅ Buat Test Page
- File: `resources/views/test-weather-api.blade.php`
- Route: `/test-weather-api`
- Untuk testing API tanpa reload dashboard

### 4. ✅ Update Route
- Pastikan dalam middleware auth
- Tambah route test page

---

## 🎯 Expected Result

Setelah perbaikan, yang seharusnya terjadi:

### Di Browser Console:
```
Fetching weather from: http://localhost:8000/api/weather/location?lat=-6.1753&lon=106.8271
Response status: 200
Weather data received: {
  success: true,
  message: "Data cuaca berhasil diambil",
  location: {...},
  forecasts: [...]
}
```

### Di Dashboard:
1. Klik "Gunakan Lokasi Saya"
2. Izinkan akses lokasi
3. Muncul: "📍 Kemayoran, Jakarta Pusat"
4. Notification: "✅ Data cuaca lokasi Anda berhasil dimuat!"
5. Page reload → Data cuaca update

---

## 📞 Jika Masih Error

### Cek Error Spesifik:

**Error 404:**
- Route tidak ada atau salah
- Server belum jalan
- URL salah

**Error 419 (CSRF):**
- CSRF token expired
- Refresh page
- Check meta tag csrf-token

**Error 401 (Unauthorized):**
- User belum login
- Session expired
- Login ulang

**Error 500:**
- Bug di controller
- Check `storage/logs/laravel.log`
- Check BMKG API response

---

## 🚀 Setelah Perbaikan

1. **Refresh halaman dashboard** (Ctrl + Shift + R)
2. **Login ulang** jika perlu
3. **Test di test page** dulu: `/test-weather-api`
4. **Cek browser console** untuk log
5. **Klik tombol lokasi** di dashboard

---

**Perbaikan sudah diterapkan! Test dengan test page dulu untuk memastikan API bekerja sebelum test di dashboard.** ✅
