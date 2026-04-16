# Group 6 — Event API (HTTP Basic Authentication)

Laravel API for the course requirement: **HTTP Basic Authentication** only. Event listings are the sample domain so you can show **routing**, **Eloquent** (`Event` → `Registration` → `Participant`), and **1,000+ rows** (`registrations`).

## How Basic Authentication works here (say this in the demo)

1. **Client** sends a header on **every** protected request:  
   `Authorization: Basic <base64(email:password)>`
2. **Laravel** runs the `auth.basic` middleware (`AuthenticateWithBasicAuth`). It decodes the header and checks the `users` table: **email** must match a row and **password** must pass `Hash::check` (stored as bcrypt).
3. If it fails → **401** with a `WWW-Authenticate: Basic` challenge. If it succeeds → `$request->user()` is the `User` model and the controller runs.
4. **No login token** and **no server session** for this method. “Logout” means the **client stops sending** the header (see `/api/v1/logout` JSON message).

That is the whole story; keep the explanation short and point to `routes/api.php` and the `auth.basic` middleware.

## Team (CCC)

| GitHub | Email |
|--------|-------|
| Jwelynie123 | dgperez@ccc.edu.ph |
| tzahhhahaha | jaamado@ccc.edu.ph |
| yumaki00 | abbayanban@ccc.edu.ph |
| mpcatedrilla | mpcatedrilla@ccc.edu.ph |
| markmasongsong | mcmasongsong@ccc.edu.ph |
| rayvenedburato | reburato@ccc.edu.ph |

Co-author hook: run `powershell -File scripts/setup-git-hooks.ps1` once after clone.

## Git branches

- `main` — presentation snapshot  
- `develop` — integration  
- `feature/integration-flow` — feature work  

## Run locally

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

### Seeded API user

- **Email:** `group6@ccc.edu.ph`  
- **Password:** `group6-password`  

After seeding you should have **1,000** rows in `registrations`.

### Endpoints

| Method | Path | Auth |
|--------|------|------|
| GET | `/api/health` | None |
| GET | `/api/v1/me` | Basic |
| POST | `/api/v1/logout` | Basic (explains client-side “logout”) |
| GET | `/api/v1/events` | Basic (paginated) |
| GET | `/api/v1/events/{id}` | Basic (event + registrations + participants) |

**Try:**

```bash
curl -u "group6@ccc.edu.ph:group6-password" http://127.0.0.1:8000/api/v1/me
```

## License

Group 6 coursework. Laravel is MIT licensed.
