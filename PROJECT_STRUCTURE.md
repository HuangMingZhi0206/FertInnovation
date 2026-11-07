# 📁 Struktur Project FertInnovation

## Directory Tree

```
agri-supply-chain-ai/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php         # Dashboard with statistics
│   │   │   ├── FarmController.php              # CRUD farms management
│   │   │   ├── WeatherController.php           # Weather data management
│   │   │   ├── HarvestController.php           # Harvest planning & tracking
│   │   │   ├── MarketPriceController.php       # Market prices display
│   │   │   ├── WaterUsageController.php        # Water usage tracking
│   │   │   ├── FertilizerController.php        # Fertilizer usage tracking
│   │   │   └── ChatbotController.php           # AI Chatbot responses
│   │   ├── Middleware/                         # Custom middleware
│   │   └── Requests/                           # Form request validation
│   └── Models/
│       ├── User.php                             # User model
│       ├── Farm.php                             # Farm/lahan model
│       ├── WeatherData.php                      # Weather data model
│       ├── HarvestData.php                      # Harvest data model
│       ├── MarketPrice.php                      # Market price model
│       ├── WaterUsage.php                       # Water usage model
│       └── FertilizerUsage.php                  # Fertilizer usage model
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_11_20_155532_create_farms_table.php
│   │   ├── 2025_11_20_155532_create_weather_data_table.php
│   │   ├── 2025_11_20_155533_create_harvest_data_table.php
│   │   ├── 2025_11_20_155533_create_market_prices_table.php
│   │   ├── 2025_11_20_155533_create_water_usages_table.php
│   │   └── 2025_11_20_155534_create_fertilizer_usages_table.php
│   └── seeders/
│       └── DatabaseSeeder.php                   # Sample data seeder
│
├── resources/
│   ├── css/
│   │   └── app.css                              # Tailwind CSS
│   ├── js/
│   │   ├── app.js                               # App JavaScript
│   │   └── bootstrap.js                         # Bootstrap config
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php                     # Main layout
│       │   ├── navigation.blade.php              # Navigation component
│       │   └── guest.blade.php                   # Guest layout
│       ├── auth/
│       │   ├── login.blade.php                   # Login form
│       │   ├── register.blade.php                # Register form
│       │   └── ...                               # Auth pages (from Breeze)
│       ├── dashboard.blade.php                   # Dashboard main page
│       ├── welcome.blade.php                     # Welcome/landing page
│       ├── farms/
│       │   ├── index.blade.php                   # List farms
│       │   ├── create.blade.php                  # Create farm
│       │   ├── edit.blade.php                    # Edit farm
│       │   └── show.blade.php                    # Farm detail
│       ├── weather/
│       │   └── index.blade.php                   # Weather monitoring
│       ├── harvest/
│       │   └── index.blade.php                   # Harvest management
│       ├── market-prices/
│       │   └── index.blade.php                   # Market prices view
│       ├── water-usage/
│       │   └── index.blade.php                   # Water usage tracking
│       ├── fertilizer-usage/
│       │   └── index.blade.php                   # Fertilizer tracking
│       └── chatbot/
│           └── index.blade.php                   # AI Chatbot interface
│
├── routes/
│   ├── web.php                                  # Web routes
│   ├── api.php                                  # API routes (for future)
│   └── auth.php                                 # Auth routes (from Breeze)
│
├── config/
│   ├── app.php                                  # Application config
│   ├── database.php                             # Database config
│   ├── cache.php                                # Cache config
│   └── ...                                      # Other configs
│
├── storage/
│   ├── app/                                     # Application storage
│   ├── logs/                                    # Application logs
│   └── framework/                               # Framework cache
│
├── tests/
│   ├── Unit/                                    # Unit tests
│   └── Feature/                                 # Feature tests
│
├── public/
│   ├── index.php                                # Entry point
│   ├── css/
│   └── js/
│
├── .env                                         # Environment variables
├── .env.example                                 # Environment template
├── .gitignore                                   # Git ignore
├── composer.json                                # PHP dependencies
├── package.json                                 # NPM dependencies
├── vite.config.js                               # Vite config
├── phpunit.xml                                  # PHPUnit config
└── README.md                                    # Project documentation
```

## Key Files Explanation

### Controllers (app/Http/Controllers/)

1. **DashboardController.php**
   - Shows overview statistics
   - Retrieves user's farms
   - Calculates metrics (farm count, total area, active harvests)
   - Gets weather, water, and fertilizer usage data

2. **FarmController.php**
   - CRUD operations for farm management
   - Show all user farms
   - Create, edit, delete farms
   - Soft delete support

3. **WeatherController.php**
   - Display weather data
   - Add new weather records
   - Filter by farm
   - Show 30-day history

4. **HarvestController.php**
   - Manage harvest planning
   - Track harvest status
   - Display harvest data
   - Calculate yields

5. **MarketPriceController.php**
   - Display market prices
   - Filter by product
   - Show trending prices
   - Display demand levels

6. **WaterUsageController.php**
   - Track water usage
   - Calculate monthly usage
   - Track water costs
   - Monitor irrigation methods

7. **FertilizerController.php**
   - Track fertilizer usage
   - Calculate monthly costs
   - Monitor fertilizer types
   - Track application methods

8. **ChatbotController.php**
   - AI responses
   - Question handling
   - Keyword matching
   - Indonesian language support

### Models (app/Models/)

All models use Eloquent ORM with:
- Timestamps (created_at, updated_at)
- Mass fillable properties
- Type casting
- Relationships defined

### Migrations (database/migrations/)

Create tables with:
- Proper foreign keys
- Indexes for performance
- Nullable/required fields
- Default values

### Views (resources/views/)

- **Layouts**: Base template with navigation
- **Components**: Reusable UI components
- **Blade Templating**: Laravel template engine
- **Responsive**: Tailwind CSS utility classes
- **Mobile-First**: Mobile responsive design

## Database Schema

### users
```
id, name, email, email_verified_at, password, 
remember_token, created_at, updated_at
```

### farms
```
id, user_id (FK), name, location, area, crop_type, 
soil_type, created_at, updated_at
```

### weather_data
```
id, farm_id (FK), date, temperature_max, 
temperature_min, humidity, rainfall, wind_speed, 
weather_condition, created_at, updated_at
```

### harvest_data
```
id, farm_id (FK), crop_type, planting_date, 
estimated_harvest_date, actual_harvest_date, 
estimated_yield, actual_yield, yield_unit, 
production_cost, status, notes, created_at, updated_at
```

### market_prices
```
id, product_name, market_location, price_per_unit, 
unit, date, demand_level, trend, created_at, updated_at
```

### water_usages
```
id, farm_id (FK), date, water_amount, water_source, 
irrigation_method, water_cost, notes, created_at, updated_at
```

### fertilizer_usages
```
id, farm_id (FK), date, fertilizer_type, quantity, 
unit, fertilizer_cost, application_method, notes, 
created_at, updated_at
```

## Routes Hierarchy

### Public Routes
- GET  / (Welcome page)
- POST /register
- POST /login

### Authenticated Routes (Protected with auth middleware)
- Dashboard: GET /dashboard
- Farms: /farms (CRUD)
- Weather: /weather (GET/POST)
- Harvest: /harvest (GET/POST)
- Market Prices: /market-prices (GET)
- Water Usage: /water-usage (GET/POST)
- Fertilizer: /fertilizer-usage (GET/POST)
- Chatbot: /chatbot (GET), /chatbot/message (POST)

## Configuration Files

### .env Variables
```
APP_NAME, APP_ENV, APP_DEBUG, APP_URL
DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, 
DB_USERNAME, DB_PASSWORD
CACHE_DRIVER, QUEUE_CONNECTION, SESSION_DRIVER
```

### composer.json
- Laravel framework
- Breeze authentication
- Development tools (testing, debugging)

### package.json
- Vite build tool
- Tailwind CSS
- Alpine.js (optional)

## Development Workflow

1. **Create Feature**
   - Create migration: `php artisan make:migration`
   - Create model: `php artisan make:model`
   - Create controller: `php artisan make:controller`

2. **Add Routes**
   - Add route in `routes/web.php`
   - Use resource routes for CRUD

3. **Create Views**
   - Create .blade.php files
   - Extend layouts/app.blade.php
   - Use Tailwind CSS classes

4. **Database Changes**
   - Run: `php artisan migrate`
   - Seed data: `php artisan db:seed`

5. **Build Assets**
   - Development: `npm run dev`
   - Production: `npm run build`

## Performance Considerations

1. **Database**
   - Use eager loading (with/load)
   - Add proper indexes
   - Paginate large datasets

2. **Frontend**
   - Minimize CSS/JS
   - Lazy load images
   - Cache static assets

3. **Caching**
   - Use query caching
   - Cache frequently accessed data
   - Use view caching

## Security Measures

1. **Authentication**
   - Laravel Breeze handles auth
   - Password hashing with bcrypt

2. **Authorization**
   - Check user ownership of resources
   - Use middleware for protection

3. **Data Validation**
   - Validate all user inputs
   - Use form requests for complex validation
   - Sanitize output

4. **CSRF Protection**
   - @csrf token in forms
   - Automatic CSRF middleware

## Testing

- Unit tests in `tests/Unit/`
- Feature tests in `tests/Feature/`
- Run with: `php artisan test`

---

**Last Updated**: November 2025
