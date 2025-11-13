# Teste Fullstack Backend

Backend service for **Teste Fullstack**, a Laravel-based API developed as part of the PicPay developer challenge.  
This project provides authentication, entity management, and region control, built with **Laravel 5.4** and **OAuth2 Passport**.

> 🧩 Challenge reference: [Teste Full Stack](https://github.com/gerfinanceirosolucoes/teste-full-stack)

---

## ⚙️ Tech Stack

- **PHP 7.0**
- **Laravel Framework 5.4**
- **MySQL 5.7**
- **Laravel Passport (OAuth2)**
- **Composer**
- **Nginx** (optional, via Docker)

---

## 🚀 Getting Started

### 1. Clone the repository
```bash
git clone https://github.com/patrickpff/teste-fullstack-frontend.git
cd teste-fullstack-backend
```

### 2. Install dependencies
```bash
composer install
```

### 3. Configure environment
Copy the example `.env` file and adjust it according to your database and app setup:

```bash
cp .env.example .env
```

Update your `.env` file with your local configuration:
```env
APP_ENV=local
APP_DEBUG=true
APP_KEY=

APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

LOG_DEPRECATIONS_CHANNEL=null
DEPRECATIONS_THROW=false

PASSWORD_CLIENT_ID=
PASSWORD_CLIENT_SECRET=

ANGULAR_URL=http://localhost:4200
```

### 4. Run migrations and seeders
```bash
php artisan migrate --seed
```

### 5. Generate application key
```bash
php artisan key:generate
```

### 6. Install Passport
```bash
php artisan passport:install
```

---

## 🧰 Running the Application

### Option 1 — Local PHP Server
```bash
php artisan serve
```
Your API will be available at:
```
http://localhost:8000
```

### Option 2 — Using Docker-Laravel (Recommended)
For an isolated development environment, you can use the **[Docker-Laravel](https://github.com/patrickpff/docker-laravel)** setup which includes:
- PHP 7.0 FPM (Alpine)
- MySQL 5.7
- Nginx

Clone it next to this project and start the containers:
```bash
docker compose up -d
```

Then serve your Laravel app inside the container:
```bash
docker-compose exec -w /var/www/html/teste-fullstack-backend php php artisan serve --host=0.0.0.0 --port=8000
```

---

## 🧠 Features

- 🔐 **Authentication with OAuth2 (Laravel Passport)**
- 🏢 **Entity management (CRUD)**
- 🌎 **Region management**
- 🍪 **Cookie-based authentication for SPA integration**
- 🧱 **CORS middleware for Angular front-end communication**

---

## 🧩 API Overview

| Method | Endpoint | Description |
|:------:|:----------|:-------------|
| `POST` | `/auth/token` | Obtain access and refresh tokens |
| `POST` | `/auth/refresh` | Refresh access token |
| `GET` | `/user` | Retrieve authenticated user |
| `GET` | `/entities` | List all entities |
| `POST` | `/entities` | Create a new entity |
| `PATCH` | `/entities/{id}` | Update an entity |
| `DELETE` | `/entities/{id}` | Delete an entity |

---

## 🧪 Testing

Run tests with:
```bash
php artisan test
```

---

## 📄 License

This project is part of a coding challenge and is shared for educational purposes.

--- 
Made with ❤️ to demonstrate secure fullstack development using Angular 17 and Laravel, with authentication handled exclusively through HTTP-only cookies.