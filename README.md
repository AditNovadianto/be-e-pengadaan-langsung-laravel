# Software Coding Documentation (SCD)

# Backend Laravel — e-Pengadaan Langsung

## 1. Project Title

**Backend Laravel — e-Pengadaan Langsung**

Dokumen ini merupakan Software Coding Documentation (SCD) untuk project backend **e-Pengadaan Langsung** yang dikembangkan menggunakan framework Laravel. Dokumen ini disusun untuk menjelaskan gambaran umum sistem, teknologi yang digunakan, struktur project, proses instalasi, konfigurasi environment, dokumentasi database, dokumentasi API, proses testing, serta rekomendasi deployment.

---

## 2. Overview

Backend e-Pengadaan Langsung adalah aplikasi backend berbasis REST API yang digunakan untuk mendukung proses pengadaan langsung secara digital. Sistem ini berfungsi sebagai pusat pengelolaan data dan logika bisnis yang akan digunakan oleh aplikasi frontend atau client lain melalui endpoint API.

Secara umum, backend ini mendukung beberapa kebutuhan utama, yaitu manajemen user, autentikasi login, pengelolaan data pengadaan, pengelolaan vendor atau penyedia, pencatatan progress pengadaan, serta pembuatan laporan terkait proses pengadaan. Sistem dibangun menggunakan arsitektur MVC (Model View Controller) yang umum digunakan pada Laravel, sehingga pemisahan antara model data, controller, routing, dan konfigurasi aplikasi dapat dilakukan secara lebih terstruktur.

Aplikasi ini dirancang agar dapat dijalankan pada environment lokal maupun container berbasis Docker. Dengan adanya konfigurasi Docker, proses setup dan deployment menjadi lebih konsisten karena aplikasi dapat dijalankan dalam container dengan dependency yang sudah didefinisikan.

---

## 3. Project Information

| Item               | Description                                       |
| ------------------ | ------------------------------------------------- |
| Nama Project       | Backend e-Pengadaan Langsung                      |
| Jenis Aplikasi     | Backend REST API                                  |
| Framework          | Laravel                                           |
| Bahasa Pemrograman | PHP                                               |
| Database           | MySQL                                             |
| Arsitektur         | REST API dan MVC                                  |
| Repository         | GitHub Repository be-e-pengadaan-langsung-laravel |

---

## 4. Technology Stack

| Technology                 | Function                                                                                        |
| -------------------------- | ----------------------------------------------------------------------------------------------- |
| PHP                        | Bahasa pemrograman utama untuk backend                                                          |
| Laravel                    | Framework utama untuk membangun REST API                                                        |
| MySQL                      | Database management system untuk menyimpan data aplikasi                                        |
| Composer                   | Dependency manager untuk package PHP                                                            |
| Docker                     | Containerization untuk menjalankan aplikasi secara konsisten                                    |
| Docker Compose             | Mengatur service container aplikasi                                                             |
| XAMPP / MySQL Local Server | Alternatif environment lokal untuk database                                                     |
| Laravel Artisan            | Command line tool Laravel untuk menjalankan migration, seeder, server, dan konfigurasi aplikasi |
| Postman / Browser          | Tools untuk melakukan pengujian API secara manual                                               |

---

## 5. Project Structure

Struktur folder project mengikuti standar Laravel. Berikut gambaran struktur utama project:

```text
📦be-e-pengadaan-langsung-laravel
 ┣ 📂app
 ┃ ┣ 📂Http
 ┃ ┃ ┗ 📂Controllers
 ┃ ┃ ┃ ┣ 📜AuthController.php
 ┃ ┃ ┃ ┣ 📜Controller.php
 ┃ ┃ ┃ ┣ 📜LaporanController.php
 ┃ ┃ ┃ ┣ 📜PengadaanController.php
 ┃ ┃ ┃ ┗ 📜ProgressController.php
 ┃ ┣ 📂Models
 ┃ ┃ ┣ 📜Laporan.php
 ┃ ┃ ┣ 📜Pengadaan.php
 ┃ ┃ ┣ 📜Penyedia.php
 ┃ ┃ ┣ 📜Progress.php
 ┃ ┃ ┣ 📜Role.php
 ┃ ┃ ┣ 📜Sistem.php
 ┃ ┃ ┗ 📜User.php
 ┃ ┗ 📂Providers
 ┃ ┃ ┗ 📜AppServiceProvider.php
 ┣ 📂bootstrap
 ┃ ┣ 📂cache
 ┃ ┃ ┗ 📜.gitignore
 ┃ ┣ 📜app.php
 ┃ ┗ 📜providers.php
 ┣ 📂config
 ┃ ┣ 📜app.php
 ┃ ┣ 📜auth.php
 ┃ ┣ 📜cache.php
 ┃ ┣ 📜database.php
 ┃ ┣ 📜filesystems.php
 ┃ ┣ 📜logging.php
 ┃ ┣ 📜mail.php
 ┃ ┣ 📜queue.php
 ┃ ┣ 📜sanctum.php
 ┃ ┣ 📜services.php
 ┃ ┗ 📜session.php
 ┣ 📂database
 ┃ ┣ 📂factories
 ┃ ┃ ┗ 📜UserFactory.php
 ┃ ┣ 📂migrations
 ┃ ┃ ┣ 📜0000_00_00_000000_create_sistems_table.php
 ┃ ┃ ┣ 📜0000_00_00_000001_create_roles_table.php
 ┃ ┃ ┣ 📜0001_01_01_000000_create_users_table.php
 ┃ ┃ ┣ 📜0001_01_01_000001_create_cache_table.php
 ┃ ┃ ┣ 📜0001_01_01_000001_create_penyedias_table.php
 ┃ ┃ ┣ 📜0001_01_01_000002_create_jobs_table.php
 ┃ ┃ ┣ 📜2026_05_21_085613_create_personal_access_tokens_table.php
 ┃ ┃ ┣ 📜2026_05_21_085804_create_pengadaans_table.php
 ┃ ┃ ┣ 📜2026_05_21_085804_create_progress_table.php
 ┃ ┃ ┗ 📜2026_05_21_090124_create_laporans_table.php
 ┃ ┣ 📂seeders
 ┃ ┃ ┣ 📜DatabaseSeeder.php
 ┃ ┃ ┗ 📜TestUserSeeder.php
 ┃ ┗ 📜.gitignore
 ┣ 📂public
 ┃ ┣ 📜.htaccess
 ┃ ┣ 📜favicon.ico
 ┃ ┣ 📜index.php
 ┃ ┗ 📜robots.txt
 ┣ 📂resources
 ┃ ┣ 📂css
 ┃ ┃ ┗ 📜app.css
 ┃ ┣ 📂js
 ┃ ┃ ┗ 📜app.js
 ┃ ┗ 📂views
 ┃ ┃ ┗ 📜welcome.blade.php
 ┣ 📂routes
 ┃ ┣ 📜api.php
 ┃ ┣ 📜console.php
 ┃ ┗ 📜web.php
 ┣ 📂storage
 ┃ ┣ 📂app
 ┃ ┃ ┣ 📂private
 ┃ ┃ ┃ ┗ 📜.gitignore
 ┃ ┃ ┣ 📂public
 ┃ ┃ ┃ ┗ 📜.gitignore
 ┃ ┃ ┗ 📜.gitignore
 ┃ ┣ 📂framework
 ┃ ┃ ┣ 📂cache
 ┃ ┃ ┃ ┣ 📂data
 ┃ ┃ ┃ ┃ ┗ 📜.gitignore
 ┃ ┃ ┃ ┗ 📜.gitignore
 ┃ ┃ ┣ 📂sessions
 ┃ ┃ ┃ ┗ 📜.gitignore
 ┃ ┃ ┣ 📂testing
 ┃ ┃ ┃ ┗ 📜.gitignore
 ┃ ┃ ┣ 📂views
 ┃ ┃ ┃ ┗ 📜.gitignore
 ┃ ┃ ┗ 📜.gitignore
 ┃ ┗ 📂logs
 ┃ ┃ ┗ 📜.gitignore
 ┣ 📂tests
 ┃ ┣ 📂Feature
 ┃ ┃ ┗ 📜ExampleTest.php
 ┃ ┣ 📂Unit
 ┃ ┃ ┗ 📜ExampleTest.php
 ┃ ┗ 📜TestCase.php
 ┣ 📜.editorconfig
 ┣ 📜.env
 ┣ 📜.env.example
 ┣ 📜.gitattributes
 ┣ 📜.gitignore
 ┣ 📜.npmrc
 ┣ 📜artisan
 ┣ 📜composer.json
 ┣ 📜composer.lock
 ┣ 📜docker-compose.yml
 ┣ 📜Dockerfile
 ┣ 📜package.json
 ┣ 📜phpunit.xml
 ┣ 📜README.md
 ┣ 📜test_api.cjs
 ┣ 📜test_results.txt
 ┗ 📜vite.config.js
```

### 5.1 Folder `app/`

Folder `app/` berisi kode utama aplikasi. Di dalamnya terdapat controller, model, middleware, dan provider yang digunakan untuk menjalankan logika sistem.

### 5.2 Folder `routes/`

Folder `routes/` digunakan untuk mendefinisikan route aplikasi. Untuk API, route utama berada pada file `routes/api.php`.

### 5.3 Folder `database/`

Folder `database/` berisi file migration dan seeder. Migration digunakan untuk membuat struktur tabel database, sedangkan seeder digunakan untuk mengisi data awal yang dibutuhkan aplikasi.

### 5.4 Folder `tests/`

Folder `tests/` digunakan untuk menyimpan file pengujian aplikasi. Pengujian dapat dilakukan menggunakan PHPUnit atau tools tambahan sesuai kebutuhan project.

---

## 6. Getting Started

Bagian ini menjelaskan langkah-langkah untuk menjalankan project pada local machine, baik menggunakan setup non-Docker maupun Docker.

### 6.1 Prerequisites

Sebelum menjalankan project, pastikan beberapa software berikut sudah tersedia:

#### Non-Docker Environment

```bash
PHP 8.3 atau lebih baru
Composer
MySQL atau XAMPP
Git
```

#### Docker Environment

```bash
Docker Desktop
Docker Compose
MySQL atau koneksi database lokal
Git
```

### 6.2 Clone Repository

Langkah pertama adalah mengambil source code dari repository GitHub:

```bash
git clone https://github.com/AditNovadianto/be-e-pengadaan-langsung-laravel.git
cd be-e-pengadaan-langsung-laravel
```

### 6.3 Install Dependencies

Jika menjalankan tanpa Docker, install dependency PHP menggunakan Composer:

```bash
composer install
```

Jika terdapat dependency frontend atau package JavaScript yang dibutuhkan, install juga menggunakan npm:

```bash
npm install
```

### 6.4 Environment Configuration

Buat file `.env` berdasarkan `.env.example`:

```bash
cp .env.example .env
```

Kemudian sesuaikan konfigurasi database:

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

Untuk environment Docker, konfigurasi database dapat menggunakan host berikut:

```env
DB_CONNECTION=mysql
DB_HOST=host.docker.internal
DB_PORT=3306
DB_DATABASE=e_pengadaan_langsung_laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

### 6.5 Generate Application Key

Laravel membutuhkan application key agar konfigurasi keamanan aplikasi dapat berjalan dengan benar.

```bash
php artisan key:generate
```

Jika menggunakan Docker:

```bash
docker exec -it be-e-pengadaan-langsung-laravel-app-1 php artisan key:generate
```

### 6.6 Run Migration and Seeder

Jalankan migration dan seeder untuk membuat struktur database dan data awal:

```bash
php artisan migrate:fresh --seed
```

Jika menggunakan Docker:

```bash
docker exec -it be-e-pengadaan-langsung-laravel-app-1 php artisan migrate:fresh --seed
```

### 6.7 Run Development Server

Untuk menjalankan aplikasi secara lokal:

```bash
php artisan serve
```

Aplikasi akan berjalan pada:

```text
http://127.0.0.1:8000
```

Untuk menjalankan menggunakan Docker:

```bash
docker compose up -d --build
```

Untuk menghentikan Docker:

```bash
docker compose down
```

Untuk melihat log aplikasi pada Docker:

```bash
docker logs -f be-e-pengadaan-langsung-laravel-app-1
```

---

## 7. Database Design

Database pada sistem e-Pengadaan Langsung disusun berdasarkan DDL yang telah dibuat. Struktur database terdiri dari beberapa tabel utama yang saling berelasi, yaitu `sistem`, `roles`, `users`, `penyedia`, `pengadaan`, `progress`, dan `laporan`. Setiap tabel memiliki primary key masing-masing dan beberapa tabel menggunakan foreign key untuk menjaga integritas data antar-entitas.

Secara umum, relasi database menggambarkan bahwa sistem memiliki user dan penyedia, user memiliki role tertentu, pengadaan dibuat oleh user dan berkaitan dengan penyedia, sedangkan progress dan laporan terhubung ke data pengadaan.

### 7.1 Tabel `sistem`

Tabel `sistem` digunakan untuk menyimpan informasi sistem yang digunakan oleh user maupun penyedia. Tabel ini menjadi acuan relasi bagi tabel `users` dan `penyedia`.

| Field         | Type         | Constraint                                    | Description                                    |
| ------------- | ------------ | --------------------------------------------- | ---------------------------------------------- |
| id_sistem     | int          | Primary Key, Auto Increment, Unique, Not Null | ID unik untuk data sistem                      |
| nama_sistem   | varchar(255) | Not Null                                      | Nama sistem                                    |
| status_sistem | varchar(255) | Not Null                                      | Status sistem, misalnya aktif atau tidak aktif |

### 7.2 Tabel `roles`

Tabel `roles` digunakan untuk menyimpan data hak akses atau peran user dalam sistem. Role ini akan digunakan oleh tabel `users` untuk menentukan jenis akses yang dimiliki oleh user.

| Field     | Type         | Constraint                                    | Description                                                                     |
| --------- | ------------ | --------------------------------------------- | ------------------------------------------------------------------------------- |
| id_role   | int          | Primary Key, Auto Increment, Unique, Not Null | ID unik untuk role                                                              |
| nama_role | varchar(255) | Not Null                                      | Nama role user, misalnya admin, panitia, atau role lain sesuai kebutuhan sistem |

### 7.3 Tabel `users`

Tabel `users` digunakan untuk menyimpan data pengguna internal sistem. User memiliki relasi ke tabel `sistem` dan `roles`, sehingga setiap user dapat dikaitkan dengan sistem tertentu dan role tertentu.

| Field         | Type         | Constraint                                    | Description                                               |
| ------------- | ------------ | --------------------------------------------- | --------------------------------------------------------- |
| id_user       | int          | Primary Key, Auto Increment, Unique, Not Null | ID unik untuk user                                        |
| nama_user     | varchar(255) | Not Null                                      | Nama user                                                 |
| email_user    | varchar(255) | Not Null                                      | Email user yang digunakan untuk login                     |
| password_user | varchar(255) | Not Null                                      | Password user yang disimpan dalam bentuk terenkripsi/hash |
| status_user   | varchar(255) | Not Null                                      | Status user, misalnya aktif atau tidak aktif              |
| id_sistem     | int          | Foreign Key, Not Null                         | Relasi ke tabel `sistem`                                  |
| id_role       | int          | Foreign Key, Not Null                         | Relasi ke tabel `roles`                                   |

Relasi foreign key:

```sql
FOREIGN KEY (id_sistem) REFERENCES sistem(id_sistem)
FOREIGN KEY (id_role) REFERENCES roles(id_role)
```

### 7.4 Tabel `penyedia`

Tabel `penyedia` digunakan untuk menyimpan data perusahaan atau vendor yang terlibat dalam proses pengadaan. Penyedia memiliki relasi ke tabel `sistem`.

| Field             | Type         | Constraint                                    | Description                                                           |
| ----------------- | ------------ | --------------------------------------------- | --------------------------------------------------------------------- |
| id_penyedia       | int          | Primary Key, Auto Increment, Unique, Not Null | ID unik untuk penyedia                                                |
| nama_perusahaan   | varchar(255) | Not Null                                      | Nama perusahaan penyedia                                              |
| email_penyedia    | varchar(255) | Not Null                                      | Email penyedia yang dapat digunakan untuk autentikasi atau komunikasi |
| password_penyedia | varchar(255) | Not Null                                      | Password penyedia yang disimpan dalam bentuk terenkripsi/hash         |
| nib               | varchar(255) | Not Null                                      | Nomor Induk Berusaha milik penyedia                                   |
| id_sistem         | int          | Foreign Key, Not Null                         | Relasi ke tabel `sistem`                                              |

Relasi foreign key:

```sql
FOREIGN KEY (id_sistem) REFERENCES sistem(id_sistem)
```

### 7.5 Tabel `pengadaan`

Tabel `pengadaan` merupakan tabel utama yang menyimpan data proses pengadaan langsung. Setiap data pengadaan berelasi dengan user sebagai pihak yang membuat atau mengelola pengadaan, serta penyedia sebagai pihak yang terlibat dalam proses pengadaan.

| Field            | Type         | Constraint                                    | Description                                    |
| ---------------- | ------------ | --------------------------------------------- | ---------------------------------------------- |
| id_pengadaan     | int          | Primary Key, Auto Increment, Unique, Not Null | ID unik untuk data pengadaan                   |
| nama_pengadaan   | varchar(255) | Not Null                                      | Nama atau judul pengadaan                      |
| pagu_anggaran    | varchar(255) | Not Null                                      | Nilai pagu anggaran pengadaan                  |
| nilai_penawaran  | varchar(255) | Nullable                                      | Nilai penawaran dari penyedia                  |
| nilai_kontrak    | varchar(255) | Nullable                                      | Nilai kontrak setelah proses pengadaan selesai |
| status_pengadaan | varchar(255) | Not Null                                      | Status proses pengadaan                        |
| id_user          | int          | Foreign Key, Not Null                         | Relasi ke tabel `users`                        |
| id_penyedia      | int          | Foreign Key, Not Null                         | Relasi ke tabel `penyedia`                     |

Relasi foreign key:

```sql
FOREIGN KEY (id_user) REFERENCES users(id_user)
FOREIGN KEY (id_penyedia) REFERENCES penyedia(id_penyedia)
```

### 7.6 Tabel `progress`

Tabel `progress` digunakan untuk menyimpan perkembangan atau persentase progress dari suatu pengadaan. Setiap progress terhubung ke satu data pengadaan.

| Field               | Type         | Constraint                                    | Description                   |
| ------------------- | ------------ | --------------------------------------------- | ----------------------------- |
| id_progress         | int          | Primary Key, Auto Increment, Unique, Not Null | ID unik untuk progress        |
| persentase_progress | varchar(255) | Not Null                                      | Persentase progress pengadaan |
| keterangan_progress | varchar(255) | Not Null                                      | Keterangan progress pengadaan |
| id_pengadaan        | int          | Foreign Key, Not Null                         | Relasi ke tabel `pengadaan`   |

Relasi foreign key:

```sql
FOREIGN KEY (id_pengadaan) REFERENCES pengadaan(id_pengadaan)
```

### 7.7 Tabel `laporan`

Tabel `laporan` digunakan untuk menyimpan dokumen atau file laporan yang berkaitan dengan pengadaan. Setiap laporan terhubung ke satu data pengadaan.

| Field             | Type         | Constraint                                    | Description                   |
| ----------------- | ------------ | --------------------------------------------- | ----------------------------- |
| id_laporan        | int          | Primary Key, Auto Increment, Unique, Not Null | ID unik untuk laporan         |
| nama_laporan      | varchar(255) | Not Null                                      | Nama laporan                  |
| file_path_laporan | varchar(255) | Not Null                                      | Lokasi atau path file laporan |
| id_pengadaan      | int          | Foreign Key, Not Null                         | Relasi ke tabel `pengadaan`   |

Relasi foreign key:

```sql
FOREIGN KEY (id_pengadaan) REFERENCES pengadaan(id_pengadaan)
```

### 7.8 Ringkasan Relasi Antar Tabel

| Tabel Asal | Field FK     | Tabel Tujuan | Field Tujuan | Keterangan                               |
| ---------- | ------------ | ------------ | ------------ | ---------------------------------------- |
| users      | id_sistem    | sistem       | id_sistem    | User terhubung dengan sistem             |
| users      | id_role      | roles        | id_role      | User memiliki role tertentu              |
| penyedia   | id_sistem    | sistem       | id_sistem    | Penyedia terhubung dengan sistem         |
| pengadaan  | id_user      | users        | id_user      | Pengadaan dibuat atau dikelola oleh user |
| pengadaan  | id_penyedia  | penyedia     | id_penyedia  | Pengadaan berhubungan dengan penyedia    |
| progress   | id_pengadaan | pengadaan    | id_pengadaan | Progress dimiliki oleh pengadaan         |
| laporan    | id_pengadaan | pengadaan    | id_pengadaan | Laporan dimiliki oleh pengadaan          |

### 7.9 Entity Relationship Overview

Relasi database dapat dijelaskan sebagai berikut:

1. Satu `sistem` dapat memiliki banyak `users`.
2. Satu `sistem` dapat memiliki banyak `penyedia`.
3. Satu `role` dapat dimiliki oleh banyak `users`.
4. Satu `user` dapat mengelola banyak `pengadaan`.
5. Satu `penyedia` dapat terlibat dalam banyak `pengadaan`.
6. Satu `pengadaan` dapat memiliki banyak `progress`.
7. Satu `pengadaan` dapat memiliki banyak `laporan`.

Dengan struktur ini, database mampu mendukung proses utama aplikasi e-Pengadaan Langsung, mulai dari pengelolaan user dan penyedia, pencatatan data pengadaan, pemantauan progress, hingga penyimpanan laporan pengadaan.

---

## 8. Authentication System

Sistem autentikasi digunakan untuk memastikan hanya user yang memiliki kredensial valid yang dapat mengakses fitur tertentu pada aplikasi.

### 8.1 Login Flow

Alur login berjalan sebagai berikut:

1. User mengirimkan `email_user` dan `password_user` melalui endpoint login.
2. Backend melakukan validasi terhadap input yang dikirimkan.
3. Sistem mencari user berdasarkan email.
4. Password dicek menggunakan mekanisme hashing `bcrypt()`.
5. Jika kredensial valid, sistem mengembalikan response login berhasil.
6. User dapat mengakses endpoint yang sesuai dengan hak aksesnya.

### 8.2 Field Login

```text
email_user
password_user
```

---

## 9. API Endpoint Documentation

### 9.1 Base URL

```text
http://127.0.0.1:8000/api
```

### 9.2 Authentication

#### Login User

```http
POST /auth/user/login
```

Request body:

```json
{
    "email_user": "panitia@test.com",
    "password_user": "password123"
}
```

Response success:

```json
{
    "success": true,
    "message": "Login berhasil"
}
```

### 9.3 Pengadaan

#### Get All Pengadaan

```http
GET /pengadaan
```

Endpoint ini digunakan untuk menampilkan seluruh data pengadaan yang tersedia pada sistem.

#### Create Pengadaan

```http
POST /pengadaan
```

Endpoint ini digunakan untuk menambahkan data pengadaan baru ke dalam database.

#### Update Pengadaan

```http
PUT /pengadaan/{id}
```

Endpoint ini digunakan untuk memperbarui data pengadaan berdasarkan ID tertentu.

#### Delete Pengadaan

```http
DELETE /pengadaan/{id}
```

Endpoint ini digunakan untuk menghapus data pengadaan berdasarkan ID tertentu.

### 9.4 Progress

#### Get Progress

```http
GET /progress
```

Endpoint ini digunakan untuk menampilkan data progress pengadaan.

#### Update Progress

```http
POST /progress
```

Endpoint ini digunakan untuk memperbarui atau menambahkan data progress pengadaan.

---

## 10. Seeder Documentation

Seeder digunakan untuk menyediakan data awal yang diperlukan agar aplikasi dapat langsung diuji setelah database dibuat. Contoh data awal yang dapat dibuat melalui seeder adalah user panitia dan vendor.

Contoh data user:

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

## 11. Migration Documentation

Migration digunakan untuk membuat struktur tabel database secara otomatis berdasarkan file migration yang tersedia pada folder `database/migrations`.

### 11.1 Menjalankan Migration Non-Docker

```bash
php artisan migrate:fresh --seed
```

### 11.2 Menjalankan Migration Docker

```bash
docker exec -it be-e-pengadaan-langsung-laravel-app-1 php artisan migrate:fresh --seed
```

---

## 12. Docker Configuration

Project mendukung penggunaan Docker untuk memudahkan proses setup dan menjalankan aplikasi. Dockerfile digunakan untuk membangun image aplikasi Laravel, sedangkan `docker-compose.yml` digunakan untuk menjalankan service aplikasi.

### 12.1 Dockerfile

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

### 12.2 docker-compose.yml

```yaml
services:
    app:
        build: .
        ports:
            - "8000:8000"
```

---

## 13. Tests

Pengujian dilakukan untuk memastikan bahwa fitur utama backend dapat berjalan sesuai dengan kebutuhan sistem. Testing dapat dilakukan secara manual menggunakan Postman, browser, atau frontend HTML yang terhubung ke API.

### 13.1 Manual Testing Tools

```text
Frontend HTML
Browser
Postman
```

### 13.2 Login Testing Account

#### Panitia

```text
Email: panitia@test.com
Password: password123
```

#### Vendor

```text
Email: makmur@test.com
Password: password123
```

### 13.3 Automated Test

Jika automated test tersedia, test dapat dijalankan menggunakan PHPUnit:

```bash
php artisan test
```

Atau menggunakan konfigurasi PHPUnit:

```bash
vendor/bin/phpunit
```

---

## 14. Error Handling

Bagian ini menjelaskan beberapa error umum yang mungkin muncul saat menjalankan aplikasi beserta cara penyelesaiannya.

### 14.1 Error 401 Unauthorized

Penyebab:

- User tidak ditemukan.
- Password salah.
- Seeder belum dijalankan.

Solusi:

```bash
php artisan migrate:fresh --seed
```

### 14.2 Error `vendor/autoload.php`

Penyebab:

- Dependency Laravel belum terinstall.

Solusi:

```bash
composer install
```

### 14.3 Error APP_KEY Missing

Penyebab:

- Application key Laravel belum dibuat.

Solusi:

```bash
php artisan key:generate
```

---

## 15. Security

Keamanan aplikasi diperhatikan melalui penggunaan hashing password dan pengamanan file environment.

### 15.1 Password Encryption

Password user disimpan menggunakan fungsi hashing:

```php
bcrypt()
```

Dengan penggunaan hashing, password tidak disimpan dalam bentuk plain text pada database.

### 15.2 Environment Security

File `.env` tidak boleh diupload ke repository public karena berisi konfigurasi sensitif, seperti nama database, username, password, dan konfigurasi aplikasi lainnya.

File `.env` harus dimasukkan ke dalam `.gitignore` agar tidak ikut ter-push ke repository.

---

## 16. Deployment

### 16.1 Development Deployment

Untuk kebutuhan development, project dapat dijalankan menggunakan:

- XAMPP
- MySQL lokal
- Docker Desktop
- Laravel development server

### 16.2 Production Deployment Recommendation

Untuk environment production, disarankan menggunakan konfigurasi server berikut:

- Ubuntu Server
- Nginx
- PHP-FPM
- MySQL Server
- SSL HTTPS
- Environment variable yang aman
- File permission yang sesuai untuk folder Laravel

### 16.3 Deployment Notes

Pada environment production, nilai `APP_ENV` sebaiknya diubah menjadi `production`, `APP_DEBUG` diubah menjadi `false`, dan konfigurasi database harus disesuaikan dengan server production.

```env
APP_ENV=production
APP_DEBUG=false
```

---

## 17. Contributing

Kontribusi pada project dilakukan melalui version control GitHub. Setiap perubahan sebaiknya dilakukan melalui branch terpisah, kemudian dilakukan review sebelum digabungkan ke branch utama.

Alur kontribusi yang disarankan:

1. Clone repository.
2. Buat branch baru sesuai fitur atau perbaikan.
3. Lakukan perubahan kode.
4. Jalankan testing.
5. Commit perubahan dengan pesan yang jelas.
6. Push branch ke repository.
7. Ajukan pull request atau merge request.

---

## 18. Release History

| Version | Description                                            |
| ------- | ------------------------------------------------------ |
| 0.1     | Initial backend setup                                  |
| 0.2     | Penambahan konfigurasi database, migration, dan seeder |
| 0.3     | Penambahan endpoint autentikasi dan pengadaan          |
| 0.4     | Penambahan konfigurasi Docker dan dokumentasi testing  |

---

## 19. Authors

| Name            | Role      |
| --------------- | --------- |
| Adit Novadianto | Developer |

---

## 20. Conclusion

Backend Laravel e-Pengadaan Langsung merupakan sistem backend berbasis REST API yang digunakan untuk mendukung proses pengadaan langsung secara digital. Sistem ini dibangun menggunakan Laravel, PHP, MySQL, serta mendukung Docker untuk mempermudah proses setup dan deployment.

Dokumentasi ini dapat digunakan sebagai referensi teknis bagi developer, tester, maupun pihak lain yang ingin memahami struktur project, konfigurasi environment, desain database, endpoint API, testing, dan deployment aplikasi.
