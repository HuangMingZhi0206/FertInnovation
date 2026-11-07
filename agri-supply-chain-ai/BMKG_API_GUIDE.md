# BMKG API Integration Guide

## 📋 Overview

The application now integrates with the **BMKG (Badan Meteorologi, Klimatologi, dan Geofisika)** API to display real-time weather forecast data.

## ✅ API Status

**The BMKG API is working correctly!** ✅

- **Base URL:** `https://api.bmkg.go.id/`
- **Endpoint:** `publik/prakiraan-cuaca`
- **Default Location:** ADM4 Code `31.71.03.1001` (Kemayoran, Jakarta Pusat)
- **Response Format:** JSON

## 🔧 How It Works

### 1. Dashboard Display

The dashboard now automatically displays BMKG weather data in two ways:

1. **Weather Card** - Shows the next forecast (temperature and condition)
2. **Weather Table** - Shows up to 10 forecast entries with detailed information

When you have **NO farms or weather data in the database**, the dashboard will automatically fall back to showing BMKG forecast data directly.

### 2. Data Flow

```
BMKG API → BmkgWeatherService → DashboardController → Blade View
```

### 3. Implementation Files

- **Service:** `app/Services/BmkgWeatherService.php`
- **Controller:** `app/Http/Controllers/DashboardController.php`
- **View:** `resources/views/dashboard/index.blade.php`
- **Command:** `app/Console/Commands/SyncBmkgWeatherData.php`

## 🚀 Testing the API

### Method 1: Browser Test Page

1. Start your Laravel development server:
   ```bash
   php artisan serve
   ```

2. Visit: `http://localhost:8000/test-bmkg.html`

This page will:
- Test the BMKG API connection
- Display location information
- Show the next 10 weather forecasts
- Provide troubleshooting tips if errors occur

### Method 2: Command Line Test

```powershell
Invoke-WebRequest -Uri "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=31.71.03.1001" -Headers @{"Accept"="application/json"} | Select-Object -ExpandProperty Content
```

### Method 3: Dashboard

1. Login to your application
2. Navigate to the Dashboard
3. Look for the **"📋 Data Cuaca Terkini"** section
4. You should see weather data with a green indicator showing **"Data dari BMKG API"**

## 📊 API Response Parameters

The BMKG API returns the following weather parameters:

| Parameter | Description | Unit |
|-----------|-------------|------|
| `t` | Temperature | °C |
| `hu` | Humidity | % |
| `ws` | Wind Speed | km/h |
| `wd` | Wind Direction | Text (N, NE, E, etc.) |
| `tp` | Rainfall/Precipitation | mm |
| `tcc` | Cloud Cover | % |
| `weather_desc` | Weather Condition (Indonesian) | Text |
| `weather_desc_en` | Weather Condition (English) | Text |
| `local_datetime` | Local Date & Time | YYYY-MM-DD HH:mm:ss |
| `vs_text` | Visibility | km |

## 💾 Syncing Data to Database

You can sync BMKG data to your database using the provided Artisan command:

### Sync for All Farms

```bash
php artisan weather:sync-bmkg
```

### Sync for Specific Farm

```bash
php artisan weather:sync-bmkg --farm_id=1
```

### What the Sync Does

- Fetches latest BMKG forecast data
- Converts forecast data to database format
- Creates or updates weather records for each farm
- Only syncs future or today's forecasts (not past data)
- Logs any errors for troubleshooting

### Automating the Sync

To automatically sync data every hour, add this to your `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('weather:sync-bmkg')->hourly();
}
```

Then ensure your scheduler is running:

```bash
php artisan schedule:work
```

## 🌍 Changing Location

To use a different location, you need to find the ADM4 code for your area:

1. ADM4 codes follow the format: `province.city.district.village`
2. Default is `31.71.03.1001` (Kemayoran, Jakarta Pusat)

### Update in `.env` file:

```env
BMKG_ADM4_CODE=31.71.03.1001
BMKG_CACHE_MINUTES=30
```

### Common ADM4 Codes:

- Jakarta Pusat, Kemayoran: `31.71.03.1001`
- (Add more as you discover them)

## 🔍 Troubleshooting

### Issue: "Belum ada data cuaca" shown

**Solutions:**
1. ✅ Check your internet connection
2. ✅ Verify BMKG API is accessible (use test page)
3. ✅ Clear Laravel cache: `php artisan cache:clear`
4. ✅ Check logs: `storage/logs/laravel.log`
5. ✅ Ensure you have at least one farm created

### Issue: API returns empty forecasts

**Possible Causes:**
- Invalid ADM4 code
- BMKG API maintenance
- Network connectivity issues

**Solution:**
Check the `storage/logs/laravel.log` file for detailed error messages.

### Issue: Old cached data shown

**Solution:**
```bash
php artisan cache:forget bmkg_forecast_31.71.03.1001
```

Or change `BMKG_CACHE_MINUTES` in `.env` to a lower value.

## 📱 Frontend Features

### Weather Indicators

The dashboard uses emojis to visually indicate weather conditions:

- ☀️ **Cerah** (Sunny)
- ☁️ **Berawan/Mendung** (Cloudy)
- 🌧️ **Hujan** (Rain)
- 🌤️ **Other conditions**

### Live Status Badge

A green pulsing indicator shows when data is coming from the BMKG API:

```
🟢 Data dari BMKG API
```

## 📈 Next Steps

1. **Create farms** - Add your agricultural lands via the "🌾 Lahan" menu
2. **Sync data** - Run `php artisan weather:sync-bmkg` to populate your database
3. **View reports** - Check the dashboard for weather trends and forecasts
4. **Set up automation** - Configure the scheduler to auto-sync data

## 🔗 Resources

- **BMKG API Documentation:** [https://api.bmkg.go.id/](https://api.bmkg.go.id/)
- **Test Page:** `/test-bmkg.html`
- **Laravel Caching:** [Laravel Cache Documentation](https://laravel.com/docs/cache)
- **Task Scheduling:** [Laravel Scheduling Documentation](https://laravel.com/docs/scheduling)

## 🎯 Summary

✅ **BMKG API is WORKING**  
✅ **Dashboard displays live weather data**  
✅ **Data can be synced to database**  
✅ **Caching prevents excessive API calls**  
✅ **Test page available for verification**

The "Belum ada data cuaca" message appears when:
1. You have NO farms in the database, OR
2. Your farms have NO weather records, OR  
3. BMKG API returns empty data

**Solution:** The updated dashboard now automatically shows BMKG forecast data even when the database is empty!
