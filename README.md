# Group 6 API (WIP)

Not finished. Laravel keeps many folders (`config`, `vendor`, …) — that is normal. Our code is mostly `app/Http/Controllers/Api`, `routes/api.php`, `database/`.

Done: Basic Auth, `/api/health`, `/api/v1/me`, `/api/v1/logout`, `/api/v1/events` (list only). Todo: single event route, more seed rows, final polish.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

User `group6@ccc.edu.ph` / `group6-password`. Co-authors: `git config core.hooksPath .githooks` after clone.
