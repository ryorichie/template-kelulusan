<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# 📢 Pengumuman Kelulusan — Laravel App

Aplikasi web berbasis Laravel untuk mengelola dan menampilkan pengumuman kelulusan siswa.

---

## 📋 Persyaratan Sistem

Sebelum memulai, pastikan sistem kamu sudah memenuhi persyaratan berikut:

| Kebutuhan       | Versi Minimum    |
| --------------- | ---------------- |
| PHP             | >= 8.1           |
| Composer        | >= 2.x           |
| Node.js         | >= 18.x          |
| NPM             | >= 9.x           |
| MySQL / MariaDB | >= 8.0 / >= 10.4 |
| Laravel         | >= 10.x          |

---

## 🚀 Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Alfi-Filsafalasafi/pengumuman-kelulusan-laravel.git
cd pengumuman-kelulusan-laravel
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi Node.js

```bash
npm install
```

### 4. Salin File Environment

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_kelulusan
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Buat Database

Buat database baru di MySQL sesuai nama yang ada di `.env`:

```sql
CREATE DATABASE db_kelulusan;
```

### 8. Jalankan Migrasi & Seeder

```bash
php artisan migrate --seed
```

> Atau jika hanya ingin migrasi tanpa seeder:
>
> ```bash
> php artisan migrate
> ```

### 9. Build Assets Frontend

```bash
# Untuk development
npm run dev

# Untuk production
npm run build
```

### 10. Jalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di browser: [http://localhost:8000](http://localhost:8000)

---

Akses Dashboard Admin
http://localhost:8000/login
username = admin@namasekolah.sch.id
password = password_sekolah

---

## 📁 Struktur Direktori

```
pengumuman-kelulusan-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Logic controller
│   │   └── Middleware/      # Middleware aplikasi
│   └── Models/              # Model Eloquent
├── database/
│   ├── migrations/          # File migrasi database
│   └── seeders/             # Data awal (seeder)
├── public/                  # File publik (entry point)
├── resources/
│   ├── views/               # Template Blade
│   ├── css/                 # Styling
│   └── js/                  # JavaScript
├── routes/
│   ├── web.php              # Route web
│   └── api.php              # Route API
├── storage/                 # File upload & log
├── tests/                   # Unit & feature test
├── .env.example             # Contoh file environment
└── artisan                  # CLI Laravel
```

---

## 📬 Kontak

Jika anda memerlukan bantuan untuk set up di hosting / server sekolah
bisa menghubungi saya melalui nomer berikut
http://wa.me/6285232842550

Dibuat dengan ❤️ oleh **Alfi Filsafalasafi**

- GitHub: [@Alfi-Filsafalasafi](https://github.com/Alfi-Filsafalasafi)
