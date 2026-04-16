# Group 6 — Laravel API (Basic Auth + events)

Most folders (`config`, `bootstrap`, `vendor`, etc.) come from **Laravel** and are required for the framework. Your project code is mainly under **`app/`**, **`routes/`**, and **`database/`**.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

User: `group6@ccc.edu.ph` / `group6-password` — `registrations` table has 1000 rows after seed.

`GET /api/health` is public. Everything under `/api/v1/*` except health uses **HTTP Basic** (`auth.basic` in `routes/api.php`).

Git hooks: `powershell -File scripts/setup-git-hooks.ps1`
