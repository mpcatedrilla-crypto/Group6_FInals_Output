# Group 6 Finals — HTTP Basic Authentication API (Laravel)

Course focus: **HTTP Basic Authentication** only (no bearer tokens or OAuth for the graded auth method). This repository demonstrates that flow; the only protected “resource” routes are generic demo rows so the project still meets the course **1,000+ database rows** and **Eloquent relationships** requirements without building an event-management product.

## Git branches

- `main` — stable, presentation-ready snapshot.
- `develop` — integration branch for ongoing work before merging to `main`.

## Team (CCC)

| GitHub | Email |
|--------|-------|
| Jwelynie123 | dgperez@ccc.edu.ph |
| tzahhhahaha | jaamado@ccc.edu.ph |
| yumaki00 | abbayanban@ccc.edu.ph |
| mpcatedrilla | mpcatedrilla@ccc.edu.ph |
| markmasongsong | mcmasongsong@ccc.edu.ph |
| rayvenedburato | reburato@ccc.edu.ph |

Every commit in this repository is intended to list all members as [GitHub co-authors](https://docs.github.com/en/pull-requests/committing-changes-to-your-project/creating-and-editing-commits/creating-a-commit-with-multiple-authors) via a shared `prepare-commit-msg` hook. Run `powershell -File scripts/setup-git-hooks.ps1` once after cloning.

## Requirements covered

- **Authentication:** Laravel `auth.basic` middleware (`Illuminate\Auth\Middleware\AuthenticateWithBasicAuth`). The client sends `Authorization: Basic base64(email:password)` on each request to protected routes.
- **API:** JSON routes under `/api`, defined in `routes/api.php`.
- **Eloquent:** `User` `hasMany` `DemoRecord`; `DemoRecord` `belongsTo` `User`.
- **Data volume:** Seeder creates **1,000** `demo_records` rows for the demo user. Run `php artisan migrate:fresh --seed`.

## Quick start

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

### Demo API user (after seeding)

- **Email:** `group6@ccc.edu.ph`
- **Password:** `group6-password`

### Endpoints

| Method | Path | Auth |
|--------|------|------|
| GET | `/api/health` | Public |
| GET | `/api/v1/me` | Basic |
| POST | `/api/v1/logout` | Basic (informational; see JSON body) |
| GET | `/api/v1/demo-records` | Basic (paginated rows for the authenticated user) |

**Example (curl):**

```bash
curl -u "group6@ccc.edu.ph:group6-password" http://127.0.0.1:8000/api/v1/me
```

## Presentation notes (Basic Auth)

- **Flow:** Browser or API client encodes `email:password` in Base64 and sends it on every protected request. Laravel validates against the `users` table (`email` + hashed `password`). There is no server session or refresh token for this method.
- **Logout:** Clearing credentials is a client responsibility (stop sending the header). The `/api/v1/logout` route returns a short explanation in JSON.
- **Strengths:** Simple to implement and debug; works well with tools like Postman; no token storage on the server.
- **Weaknesses:** Credentials are re-sent on every request; Base64 is not encryption (always use HTTPS); no fine-grained revocation without changing passwords.

## License

Application code by Group 6 for academic use. Laravel framework is open-source software licensed under the MIT license.
