# Software Coding Documentation (SCD)

# Backend Laravel — e-Pengadaan Langsung

---

# 1. Informasi Project

## Nama Project

Backend e-Pengadaan Langsung

## Framework

- Laravel 13

## Bahasa Pemrograman

- PHP 8.4

## Database

- MySQL

## Arsitektur

- REST API
- MVC (Model View Controller)

## Tujuan Sistem

Sistem backend ini digunakan untuk mendukung proses pengadaan langsung secara digital, meliputi:

- Manajemen user
- Login authentication
- Pengelolaan pengadaan
- Pengelolaan vendor/penyedia
- Pengiriman penawaran
- Tracking progress pengadaan
- Pembuatan laporan

---

# 2. Struktur Project

```text
backend-laravel/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
│   └── Providers/
│
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
├── resources/
├── routes/
│   └── api.php
│
├── storage/
├── tests/
├── artisan
├── composer.json
├── Dockerfile
├── docker-compose.yml
└── .env
```

---

# 3. Teknologi yang Digunakan

| Teknologi       | Fungsi                     |
| --------------- | -------------------------- |
| PHP 8.4         | Bahasa pemrograman backend |
| Laravel 13      | Framework backend          |
| MySQL           | Database management system |
| Composer        | Dependency manager PHP     |
| Docker          | Containerization           |
| XAMPP           | Local server environment   |
| Laravel Artisan | Command line Laravel       |

---

# 4. Setup Environment

## 4.1 Requirement

### Non-Docker

- PHP 8.3+
- Composer
- MySQL/XAMPP

### Docker

- Docker Desktop
- MySQL/XAMPP

---

# 5. Konfigurasi Environment

## File `.env`

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_pengadaan_langsung_laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

## Docker `.env`

```env
DB_CONNECTION=mysql
DB_HOST=host.docker.internal
DB_PORT=3306
DB_DATABASE=e_pengadaan_langsung_laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

---

# 6. Database Design

## 6.1 Tabel `users`

| Field         | Tipe    | Keterangan    |
| ------------- | ------- | ------------- |
| id_user       | bigint  | Primary Key   |
| nama_user     | varchar | Nama user     |
| email_user    | varchar | Email user    |
| password_user | varchar | Password user |
| status_user   | varchar | Status akun   |
| id_sistem     | bigint  | Relasi sistem |
| id_role       | bigint  | Relasi role   |

---

## 6.2 Tabel `roles`

| Field     | Tipe    | Keterangan  |
| --------- | ------- | ----------- |
| id_role   | bigint  | Primary Key |
| nama_role | varchar | Nama role   |

---

## 6.3 Tabel `sistems`

| Field       | Tipe    | Keterangan  |
| ----------- | ------- | ----------- |
| id_sistem   | bigint  | Primary Key |
| nama_sistem | varchar | Nama sistem |

---

## 6.4 Tabel `penyedias`

| Field            | Tipe    | Keterangan    |
| ---------------- | ------- | ------------- |
| id_penyedia      | bigint  | Primary Key   |
| nama_penyedia    | varchar | Nama vendor   |
| alamat_penyedia  | text    | Alamat vendor |
| email_penyedia   | varchar | Email vendor  |
| telepon_penyedia | varchar | Nomor telepon |

---

## 6.5 Tabel `pengadaans`

| Field               | Tipe    | Keterangan       |
| ------------------- | ------- | ---------------- |
| id_pengadaan        | bigint  | Primary Key      |
| nama_pengadaan      | varchar | Nama pengadaan   |
| deskripsi_pengadaan | text    | Deskripsi        |
| nilai_hps           | decimal | Nilai HPS        |
| nilai_penawaran     | decimal | Nilai penawaran  |
| nilai_kontrak       | decimal | Nilai kontrak    |
| status_pengadaan    | varchar | Status pengadaan |
| id_penyedia         | bigint  | Relasi penyedia  |

---

## 6.6 Tabel `progress`

| Field               | Tipe    | Keterangan         |
| ------------------- | ------- | ------------------ |
| id_progress         | bigint  | Primary Key        |
| id_pengadaan        | bigint  | Relasi pengadaan   |
| progress_persen     | varchar | Progress           |
| keterangan_progress | text    | Deskripsi progress |

---

## 6.7 Tabel `laporans`

| Field        | Tipe   | Keterangan       |
| ------------ | ------ | ---------------- |
| id_laporan   | bigint | Primary Key      |
| id_pengadaan | bigint | Relasi pengadaan |
| isi_laporan  | text   | Isi laporan      |

---

# 7. Authentication System

## Login Flow

Sistem menggunakan custom authentication.

### Field Login

```text
email_user
password_user
```

### Authentication Process

1. User mengirim email dan password
2. Backend melakukan validasi user
3. Password dicek menggunakan bcrypt
4. Jika valid maka token/session diberikan
5. User dapat mengakses endpoint protected

---

# 8. API Endpoint Documentation

## Base URL

```text
http://127.0.0.1:8000/api
```

---

## 8.1 Authentication

### Login User

```http
POST /auth/user/login
```

### Request Body

```json
{
    "email_user": "panitia@test.com",
    "password_user": "password123"
}
```

### Response Success

```json
{
    "success": true,
    "message": "Login berhasil"
}
```

---

## 8.2 Pengadaan

### Get All Pengadaan

```http
GET /pengadaan
```

### Create Pengadaan

```http
POST /pengadaan
```

### Update Pengadaan

```http
PUT /pengadaan/{id}
```

### Delete Pengadaan

```http
DELETE /pengadaan/{id}
```

---

## 8.3 Progress

### Get Progress

```http
GET /progress
```

### Update Progress

```http
POST /progress
```

---

# 9. Seeder Documentation

## DatabaseSeeder.php

Seeder digunakan untuk membuat data default.

Contoh:

```php
User::create([
    'nama_user' => 'Panitia Lelang',
    'email_user' => 'panitia@test.com',
    'password_user' => bcrypt('password123'),
    'status_user' => 'ACTIVE',
    'id_sistem' => 1,
    'id_role' => 1,
]);
```

---

# 10. Migration Documentation

## Menjalankan Migration

### Non-Docker

```bash
php artisan migrate:fresh --seed
```

### Docker

```bash
docker exec -it be-e-pengadaan-langsung-laravel-app-1 php artisan migrate:fresh --seed
```

---

# 11. Docker Configuration

## Dockerfile

```dockerfile
FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip

RUN docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --ignore-platform-reqs

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
```

---

## docker-compose.yml

```yaml
services:
    app:
        build: .
        ports:
            - "8000:8000"
```

---

# 12. Command Documentation

## Composer Install

```bash
composer install
```

---

## Generate APP_KEY

```bash
php artisan key:generate
```

Docker:

```bash
docker exec -it be-e-pengadaan-langsung-laravel-app-1 php artisan key:generate
```

---

## Run Laravel

### Non-Docker

```bash
php artisan serve
```

### Docker

```bash
docker compose up -d --build
```

---

## Stop Docker

```bash
docker compose down
```

---

## View Logs Docker

```bash
docker logs -f be-e-pengadaan-langsung-laravel-app-1
```

---

# 13. Error Handling

## Error 401 Unauthorized

### Penyebab

- User tidak ditemukan
- Password salah
- Seeder belum dijalankan

### Solusi

```bash
php artisan migrate:fresh --seed
```

---

## Error vendor/autoload.php

### Penyebab

Dependency belum terinstall.

### Solusi

```bash
composer install
```

---

## Error APP_KEY Missing

### Solusi

```bash
php artisan key:generate
```

---

# 14. Security

## Password Encryption

Password menggunakan:

```php
bcrypt()
```

---

## Environment Security

File `.env` tidak boleh diupload ke repository public.

Tambahkan `.env` pada `.gitignore`.

---

# 15. Testing

## Manual Testing

Testing dilakukan menggunakan:

- Frontend HTML
- Browser
- Postman

---

## Login Testing

### Panitia

```text
Email: panitia@test.com
Password: password123
```

### Vendor

```text
Email: vendor@test.com
Password: password123
```

---

# 16. Deployment Recommendation

## Development

- XAMPP
- Docker Desktop

## Production

Disarankan menggunakan:

- Ubuntu Server
- Nginx
- PHP-FPM
- MySQL Server
- SSL HTTPS

---

# 17. Kesimpulan

Backend Laravel e-Pengadaan Langsung dibangun menggunakan arsitektur REST API berbasis Laravel dengan dukungan Docker dan MySQL.

Sistem mendukung:

- Authentication
- CRUD Pengadaan
- Tracking Progress
- Vendor Management
- Seeder otomatis
- Dockerized deployment

Dokumentasi ini digunakan sebagai referensi pengembangan, maintenance, dan deployment sistem backend e-Pengadaan Langsung.
