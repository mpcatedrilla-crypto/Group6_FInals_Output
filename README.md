# Group 6 — Laravel API (in progress)

**Status:** not final — mid-term progress for instructor review.

**Done so far**
- HTTP Basic Auth on protected routes (`auth.basic`).
- `GET /api/health` (public).
- `GET /api/v1/me`, `POST /api/v1/logout`.
- `GET /api/v1/events` (paginated list with registration counts).

**Still to do (before submission)**
- `GET /api/v1/events/{id}` with registrations and participants.
- Grow seeded data toward the course requirement (1000+ rows in `registrations`).
- Polish and presentation run-through.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Demo user: `group6@ccc.edu.ph` / `group6-password` — current seed has **120** registration rows (placeholder volume).

`GET /api/health` is public; other `/api/v1/*` routes use Basic Auth.

Git hooks: `powershell -File scripts/setup-git-hooks.ps1`
