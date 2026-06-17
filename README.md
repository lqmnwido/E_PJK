<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/lqmnwido/E_PJK/actions"><img src="https://github.com/lqmnwido/E_PJK/actions/workflows/tests.yml/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# E_PJK - Laravel Application

A Laravel 13 application with **Livewire 4**, **Laravel Jetstream**, **Sanctum**, **Tailwind CSS v4**, and Vite.

---

## Stack

| Layer | Technology |
|-------|------------|
| **PHP** | 8.4+ |
| **Framework** | Laravel 13.x |
| **Frontend** | Livewire 4, Alpine.js, Tailwind CSS v4, Bootstrap 5 |
| **Auth & Profiles** | Laravel Jetstream (Livewire stack), Fortify, Sanctum |
| **Build Tool** | Vite 8 |
| **Testing** | PHPUnit 13, ParaTest 7 |
| **Code Style** | Laravel Pint |
| **Database** | MySQL / PostgreSQL / SQLite (configurable) |

---

## Features

- **User authentication** - Registration, login, email verification, password reset
- **Profile management** - Update profile information, profile photos, password
- **Two-factor authentication** - TOTP via Laravel Fortify
- **API tokens** - Laravel Sanctum for SPA / mobile auth
- **Team support** - Jetstream teams (optional)
- **Modern UI** - Tailwind CSS v4, Bootstrap 5, and Vite
- **Background jobs** - Queue workers with database/Redis
- **Scheduled tasks** - Laravel Scheduler

---

## Requirements

- PHP >= 8.4
- Composer >= 2.0
- Node.js >= 20 / npm >= 10
- Database: MySQL 8+, PostgreSQL 14+, or SQLite

---

## Quick Start

```bash
# Clone
git clone https://github.com/lqmnwido/E_PJK.git
cd E_PJK

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Environment
cp .env.example .env
php artisan key:generate

# Database (edit .env first)
php artisan migrate --seed

# Build assets
npm run build

# Development server (all-in-one with concurrently)
composer run dev

# Or separately:
# php artisan serve
# npm run dev
```

---

## Environment Variables

Key `.env` settings:

```env
APP_NAME="E_PJK"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_pjk
DB_USERNAME=root
DB_PASSWORD=

# Optional: Redis for queues/cache
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Mail
MAIL_MAILER=log
# MAIL_MAILER=smtp
# MAIL_HOST=...
```

---

## Testing

```bash
# Run all tests
php artisan test

# Run tests in parallel, matching CI
php artisan test --parallel

# Run PHPUnit directly
vendor/bin/phpunit
```

---

## Code Style

```bash
# Check
./vendor/bin/pint --test

# Fix
./vendor/bin/pint
```

---

## Deployment

### Production Checklist

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` set
- [ ] Database migrated: `php artisan migrate --force`
- [ ] Assets built: `npm run build`
- [ ] Config cached: `php artisan config:cache`
- [ ] Routes cached: `php artisan route:cache`
- [ ] Views cached: `php artisan view:cache`
- [ ] Queue worker running: `php artisan queue:work --daemon`
- [ ] Scheduler: `* * * * * php artisan schedule:run`

### Docker (optional)

```dockerfile
# Example: use official Laravel Sail or custom
```

---

## Project Structure Highlights

```
app/
├── Actions/Fortify/        # Custom Fortify actions (CreateUser, UpdateProfile)
├── Models/                 # Eloquent models (User, Profile, ...)
├── Http/Controllers/       # Controllers
└── Providers/              # Service providers
resources/
├── views/                  # Blade components & pages
├── css/app.css             # Tailwind v4 entry
└── js/app.js               # Alpine + Livewire entry
routes/
├── web.php                 # Web routes
└── api.php                 # API routes
database/
├── migrations/             # Schema
├── factories/              # Model factories
└── seeders/                # Database seeders
```

---

## Key Commands Reference

```bash
# Clear all caches
php artisan optimize:clear

# Rebuild autoload
composer dump-autoload -o

# Build frontend assets
npm run build

# Run Pint
vendor/bin/pint

# Run migrations fresh + seed
php artisan migrate:fresh --seed
```

---

## Contributing

1. Fork the repo
2. Create a feature branch: `git checkout -b feature/my-feature`
3. Make changes, run tests & Pint
4. Submit a Pull Request

---

## Security

If you discover a security vulnerability, please email the maintainer directly instead of opening an issue.

---

## License

This project is open-sourced software licensed under the [MIT license](LICENSE.md).
