# 🐳 Docker Containerization — Depi DevOps Project

> **Branch:** `feature/dockerization`
> **One-command deployment** of the full Laravel eCommerce stack using Docker.

---

## 📋 Overview

This branch adds complete Docker containerization to the Laravel eCommerce application, enabling **any developer with Docker** to spin up the entire stack (PHP, Nginx, MySQL, Redis) with a single command — no local PHP, Composer, or Node.js installation required.

### Key Features

- ✅ **Multi-stage Dockerfile** — Builds frontend (Vite) and backend (Composer) in separate stages for a lean production image
- ✅ **PHP 8.4-FPM** — Latest stable PHP with all required extensions
- ✅ **Automated initialization** — Migrations, seeding, key generation, and caching handled automatically on first boot
- ✅ **Zero application code changes** — All Docker files are additive; no existing source files were modified
- ✅ **Persistent data** — MySQL data and uploaded files survive container restarts
- ✅ **Production-optimized** — OPcache, route/config/view caching, gzip compression, static asset caching

---

## 🏗️ Architecture

```
┌─────────────────────────────────────────────────────┐
│                   Docker Compose                     │
│                                                      │
│  ┌──────────┐    ┌──────────┐    ┌──────────┐       │
│  │  Nginx   │───▶│   App    │───▶│  MySQL   │       │
│  │ :8080→80 │    │ PHP-FPM  │    │  8.0     │       │
│  └──────────┘    │ 8.4      │    │ :3307→   │       │
│       │          └──────────┘    │  3306    │       │
│       │               │          └──────────┘       │
│  Static Assets    ┌──────────┐                      │
│  (shared vol)     │  Redis   │                      │
│                   │  Alpine  │                      │
│                   └──────────┘                      │
│                                                      │
│              Network: depi-network                   │
└─────────────────────────────────────────────────────┘
```

| Service | Image | Container Name | Purpose |
|---------|-------|----------------|---------|
| **app** | Custom (Dockerfile) | `depi-devops-app` | Laravel PHP-FPM application |
| **nginx** | `nginx:alpine` | `depi-devops-nginx` | Web server & reverse proxy |
| **db** | `mysql:8.0` | `depi-devops-db` | Database |
| **redis** | `redis:alpine` | `depi-devops-redis` | Cache & session store |

---

## 📁 Files Added

```
├── Dockerfile                    # Multi-stage build (Node → Composer → PHP 8.4-FPM)
├── docker-compose.yml            # Service orchestration (app, nginx, db, redis)
├── .env.docker                   # Pre-configured environment variables for Docker
├── .dockerignore                 # Excludes node_modules, vendor, .git from build
├── DOCKER_README.md              # This file
└── docker/
    ├── entrypoint.sh             # Startup script (migrations, seeding, caching)
    ├── nginx/
    │   └── default.conf          # Nginx config with 600s timeouts, gzip, security headers
    └── php/
        ├── custom.ini            # PHP tuning (50MB uploads, OPcache, 256MB memory)
        └── www.conf              # FPM pool config (50 workers, 600s request timeout)
```

---

## 🚀 Quick Start

### Prerequisites

- [Docker](https://docs.docker.com/get-docker/) (v20+)
- [Docker Compose](https://docs.docker.com/compose/install/) (v2+)

### Run the Application

```bash
# Clone the repository
git clone https://github.com/YUSEF-RAMY/DevOps-Final_Project.git
cd DevOps-Final_Project

# Switch to the dockerization branch
git checkout feature/dockerization

# Build and start all services (first run takes ~5-8 minutes)
docker compose up --build -d

# Watch the startup progress
docker compose logs -f app
```

Wait until you see:
```
============================================
  ✅ Depi DevOps Project is ready!
  🌐 http://localhost:8080
  🔐 Admin: http://localhost:8080/admin/login
============================================
```

### Access the Application

| URL | Description |
|-----|-------------|
| http://localhost:8080 | 🛒 Storefront |
| http://localhost:8080/admin/login | 🔐 Admin Panel |

**Admin Credentials:**
- **Email:** `needyamin@gmail.com`
- **Password:** `needyamin@gmail.com`

---

## 🔧 Common Commands

```bash
# Start in background
docker compose up -d --build

# View real-time logs
docker compose logs -f app

# Stop all services (data preserved)
docker compose down

# Full reset (wipes database & uploads)
docker compose down -v
docker compose up --build -d

# Enter the app container shell
docker compose exec app bash

# Run artisan commands
docker compose exec app php artisan tinker
docker compose exec app php artisan migrate:status

# Check container status
docker compose ps
```

---

## ⚙️ Configuration

### Environment Variables

All environment variables are pre-configured in `.env.docker`. Key settings:

| Variable | Default | Description |
|----------|---------|-------------|
| `DB_HOST` | `db` | MySQL service name |
| `DB_DATABASE` | `depi_devops` | Database name |
| `DB_USERNAME` | `yusef` | Database user |
| `DB_PASSWORD` | `password` | Database password |
| `REDIS_HOST` | `redis` | Redis service name |
| `APP_URL` | `http://localhost:8080` | Application URL |

### Ports

| Host Port | Container Port | Service |
|-----------|---------------|---------|
| `8080` | `80` | Nginx (web) |
| `3307` | `3306` | MySQL |

### Volumes (Persistent Data)

| Volume | Path | Purpose |
|--------|------|---------|
| `mysql_data` | `/var/lib/mysql` | Database storage |
| `app_storage` | `/var/www/html/storage/app/public` | Uploaded files (product images) |
| `app_public` | `/var/www/html/public` | Shared static assets (Nginx ↔ App) |

---

## 🔄 Startup Lifecycle

The `docker/entrypoint.sh` script runs automatically on every container start:

1. **Sync public assets** → Copies built assets to the shared Nginx volume
2. **Wait for MySQL** → Retries connection up to 30 times (60s total)
3. **Create storage directories** → Ensures `storage/` structure exists with correct permissions
4. **Create storage symlink** → Links `public/storage` → `storage/app/public`
5. **Clear stale caches** → Removes cached config from previous runs
6. **Generate APP_KEY** → Auto-generates if not already set
7. **Run migrations** → `php artisan migrate --force`
8. **Seed database** → `php artisan db:seed --force` (idempotent)
9. **Cache for production** → Config, routes, and views cached
10. **Start PHP-FPM** → Application is ready to serve requests

---

## 🐛 Troubleshooting

### 504 Gateway Timeout
All timeouts are set to 600s. If you still see 504s during the first boot, the entrypoint is still running migrations/seeding. Wait for the "ready" message in logs:
```bash
docker compose logs -f app
```

### Container keeps restarting
Check logs for errors:
```bash
docker compose logs app | tail -50
```

### Port 8080 or 3307 already in use
```bash
# Find what's using the port
sudo lsof -i :8080
# Or change ports in docker-compose.yml
```

### Reset everything
```bash
docker compose down -v
docker compose up --build -d
```

---

## 📊 Performance Tuning

| Component | Setting | Value |
|-----------|---------|-------|
| **PHP-FPM** | Max workers | 50 |
| **PHP-FPM** | Request timeout | 600s |
| **PHP** | Memory limit | 256MB |
| **PHP** | Upload max | 50MB |
| **PHP** | OPcache | Enabled |
| **Nginx** | Gzip | Enabled |
| **Nginx** | Static asset cache | 30 days |
| **Nginx** | FastCGI timeout | 600s |

---

## 👥 Contributors

| Name | Role |
|------|------|
| Yusef Ramy | DevOps Engineer |
