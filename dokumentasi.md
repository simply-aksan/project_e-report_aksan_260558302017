# Panduan Lengkap: Hosting Proyek Laravel di Vercel dengan Database Supabase (PostgreSQL)

Dokumentasi ini dibuat sebagai panduan langkah-demi-langkah bagi siapa pun yang ingin mendeploy aplikasi Laravel ke **Vercel (Serverless)** dengan database cloud gratis dari **Supabase (PostgreSQL)**.

---

## Daftar Isi
1. [Karakteristik & Tantangan Serverless (Wajib Tahu)](#1-karakteristik--tantangan-serverless-wajib-tahu)
2. [Prasyarat](#2-prasyarat)
3. [Langkah 1: Setup Database di Supabase](#langkah-1-setup-database-di-supabase)
4. [Langkah 2: Konfigurasi Proyek Laravel untuk Vercel](#langkah-2-konfigurasi-proyek-laravel-untuk-vercel)
   - [2.1 File `api/index.php`](#21-file-apiindexphp)
   - [2.2 File `vercel.json`](#22-file-verceljson)
   - [2.3 Konfigurasi `bootstrap/app.php` (Trusted Proxies & Storage)](#23-konfigurasi-bootstrapappphp-trusted-proxies--storage)
   - [2.4 Paksa HTTPS di `app/Providers/AppServiceProvider.php`](#24-paksa-https-di-appprovidersappserviceproviderphp)
   - [2.5 Aset Frontend & Livewire (Jika menggunakan Livewire)](#25-aset-frontend--livewire-jika-menggunakan-livewire)
   - [2.6 Keamanan Form Autentikasi](#26-keamanan-form-autentikasi)
5. [Langkah 3: Migrasi & Seeding Database ke Supabase dari Komputer Lokal](#langkah-3-migrasi--seeding-database-ke-supabase-dari-komputer-lokal)
6. [Langkah 4: Deploy Proyek ke Vercel](#langkah-4-deploy-proyek-ke-vercel)
7. [Troubleshooting & Solusi Masalah Umum](#troubleshooting--solusi-masalah-umum)

---

## 1. Karakteristik & Tantangan Serverless (Wajib Tahu)
Sebelum mulai, pahami bahwa Vercel adalah platform **Serverless (Read-Only Filesystem)**:
1. **Penyimpanan Lokal Bersifat Sementara**: Folder selain `/tmp` tidak bisa ditulisi (*read-only*). File cache, session file, dan view compiled harus diarahkan ke `/tmp`.
2. **SQLite Kurang Cocok untuk Production**: Karena file SQLite di serverless akan reset setiap fungsi cold-start/idle, kita wajib memakai database cloud eksternal seperti PostgreSQL (Supabase).
3. **Reverse Proxy HTTPS**: Vercel menjalankan fungsi serverless di balik proxy HTTPS. Laravel harus dikonfigurasi agar mengenali header proxy dan selalu men-generate link HTTPS agar tidak terkena *Mixed Content Error*.

---

## 2. Prasyarat
Pastikan kamu dan temanmu sudah memiliki:
- Akun [GitHub](https://github.com)
- Akun [Vercel](https://vercel.com) (login menggunakan akun GitHub)
- Akun [Supabase](https://supabase.com) (login menggunakan akun GitHub)
- Komputer lokal dengan PHP (minimal versi 8.2+ dengan ekstensi `pdo_pgsql` aktif) dan Composer

---

## Langkah 1: Setup Database di Supabase

1. Masuk ke dashboard [Supabase](https://supabase.com) dan klik **New Project**.
2. Masukkan rincian:
   - **Name**: Nama database bebas (contoh: `my-laravel-db`).
   - **Database Password**: Buat password yang kuat dan **simpan/catat password ini**.
   - **Region**: Pilih region terdekat (misal: *Singapore (ap-southeast-1)* atau *Tokyo (ap-northeast-1)*).
3. Klik **Create new project** dan tunggu 1-2 menit hingga statusnya selesai di-*provisioning*.
4. **PENTING: Dapatkan Kredensial Connection Pooler (IPv4 Compatible)**:
   - Buka menu **Project Settings** (ikon gerigi di kiri bawah) > **Database**.
   - Scroll ke bagian **Connection parameters** atau klik tombol **Connect** di bagian atas.
   - Pilih tab **Session pooler** (Port `5432` atau `6543`).
   > **Kenapa pakai Pooler?** Direct host (`db.xxxx.supabase.co`) hanya mendukung IPv6. Sebagian besar koneksi internet rumah dan beberapa server cloud tidak memiliki rute IPv6 murni. Menggunakan Connection Pooler (`aws-0-[region].pooler.supabase.com`) menjamin koneksi IPv4 berjalan lancar tanpa error timeout!
   
   Catat data berikut:
   - **Host**: contoh `aws-0-ap-northeast-1.pooler.supabase.com`
   - **Port**: `5432`
   - **Database**: `postgres`
   - **User**: `postgres.[PROJECT_REF]` (contoh: `postgres.runodmujjoqidlddhzzm`)
   - **Password**: Password yang kamu buat tadi

---

## Langkah 2: Konfigurasi Proyek Laravel untuk Vercel

Ada beberapa file konfigurasi yang perlu disiapkan di dalam folder proyek Laravel kamu:

### 2.1 File `api/index.php`
Buat folder `api` di root proyek, lalu buat file `api/index.php`. File ini bertindak sebagai pintu masuk (*serverless function entrypoint*) yang meneruskan request ke `public/index.php` Laravel serta membuat folder sementara di `/tmp`.

```php
<?php

// 1. Deteksi otomatis protokol HTTPS dari reverse proxy Vercel
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

// 2. Buat folder sementara di /tmp yang wajib ada di lingkungan serverless
$tmpDirs = [
    '/tmp/views',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app/public',
    '/tmp/bootstrap/cache',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// 3. Teruskan ke public/index.php bawaan Laravel
require __DIR__ . '/../public/index.php';
```

---

### 2.2 File `vercel.json`
Buat file `vercel.json` di root proyek untuk mengatur runtime PHP dan routing file statis:

```json
{
  "version": 2,
  "framework": null,
  "outputDirectory": "public",
  "functions": {
    "api/index.php": {
      "runtime": "vercel-php@0.9.0"
    }
  },
  "routes": [
    {
      "src": "/build/(.*)",
      "dest": "/public/build/$1"
    },
    {
      "src": "/assets/(.*)",
      "dest": "/public/assets/$1"
    },
    {
      "src": "/vendor/(.*)",
      "dest": "/public/vendor/$1"
    },
    {
      "src": "/favicon.svg",
      "dest": "/public/favicon.svg"
    },
    {
      "src": "/favicon.ico",
      "dest": "/public/favicon.ico"
    },
    {
      "src": "/robots.txt",
      "dest": "/public/robots.txt"
    },
    {
      "src": "/(.*)",
      "dest": "/api/index.php"
    }
  ],
  "env": {
    "APP_ENV": "production",
    "APP_DEBUG": "false",
    "APP_CONFIG_CACHE": "/tmp/bootstrap/cache/config.php",
    "APP_EVENTS_CACHE": "/tmp/bootstrap/cache/events.php",
    "APP_PACKAGES_CACHE": "/tmp/bootstrap/cache/packages.php",
    "APP_ROUTES_CACHE": "/tmp/bootstrap/cache/routes.php",
    "APP_SERVICES_CACHE": "/tmp/bootstrap/cache/services.php",
    "VIEW_COMPILED_PATH": "/tmp/views",
    "CACHE_STORE": "array",
    "LOG_CHANNEL": "stderr"
  }
}
```

---

### 2.3 Konfigurasi `bootstrap/app.php` (Trusted Proxies & Storage)
Buka file `bootstrap/app.php`, pastikan:
1. Menambahkan `$middleware->trustProxies(at: '*');` agar Laravel mengenali header HTTPS dari Vercel.
2. Mengalihkan storage path ke `/tmp/storage` saat berjalan di Vercel.

Contoh `bootstrap/app.php` (Laravel 11 / 12):
```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Percayai seluruh reverse proxy Vercel
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Arahkan storage path ke /tmp di lingkungan Vercel
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || !empty(getenv('VERCEL'))) {
    $app->useStoragePath('/tmp/storage');
}

return $app;
```

---

### 2.4 Paksa HTTPS di `app/Providers/AppServiceProvider.php`
Buka `app/Providers/AppServiceProvider.php` dan tambahkan `URL::forceScheme('https')` agar semua fungsi `route()`, `url()`, dan `asset()` selalu memakai `https://`:

```php
namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->environment('production') || !empty(getenv('VERCEL')) || isset($_SERVER['VERCEL'])) {
            URL::forceScheme('https');
        }
    }
}
```

---

### 2.5 Aset Frontend & Livewire (Jika menggunakan Livewire)
1. **Build Aset Vite**:
   Jalankan build frontend di komputer lokal agar file hasil compile masuk ke `public/build`:
   ```bash
   npm run build
   ```
2. **Publish Aset Livewire**:
   Jika proyekmu menggunakan Laravel Livewire, file JavaScript Livewire harus di-publish agar bisa disajikan langsung secara statis oleh Vercel CDN:
   ```bash
   php artisan livewire:publish --assets
   ```
   *File akan tersalin ke folder `public/vendor/livewire/`.*

---

### 2.6 Keamanan Form Autentikasi
Pastikan seluruh tag `<form>` di Blade (terutama Login & Registrasi) memiliki atribut metode **POST** dan token CSRF:
```html
<form method="POST" action="#" wire:submit="login" class="space-y-4">
    @csrf
    <!-- Input email & password -->
</form>
```
> **Kenapa ini penting?** Jika JavaScript Livewire belum sempat termuat dan form tidak memiliki atribut `method="POST"`, browser secara default akan mengirim form dengan metode `GET`. Hal ini menyebabkan password bocor ke URL sebagai *query parameter* (`/login?password=...`).

---

## Langkah 3: Migrasi & Seeding Database ke Supabase dari Komputer Lokal

Karena Vercel serverless tidak menyediakan terminal SSH interaktif untuk menjalankan `php artisan migrate`, kita jalankan migrasi database **sekali saja dari komputer lokal** yang terhubung langsung ke Supabase.

1. Buka file `.env` di komputer lokal kamu.
2. Isi konfigurasi database dengan kredensial Supabase kamu:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=aws-0-[region].pooler.supabase.com
   DB_PORT=5432
   DB_DATABASE=postgres
   DB_USERNAME=postgres.[PROJECT_REF]
   DB_PASSWORD="PASSWORD_SUPABASE_KAMU"
   DB_SSLMODE=require
   ```
   *(Gunakan tanda kutip ganda `""` pada password jika terdapat karakter simbol khusus).*
3. Buka terminal di folder proyek lokal, lalu jalankan:
   ```bash
   php artisan migrate:fresh --seed
   ```
4. Verifikasi bahwa semua tabel berhasil terbuat dan seeder akun awal (seperti admin) sukses dijalankan di Supabase.

---

## Langkah 4: Deploy Proyek ke Vercel

1. **Commit dan Push ke GitHub**:
   Pastikan folder `public/build` dan `public/vendor` ikut ter-commit ke repositori GitHub kamu:
   ```bash
   git add .
   git commit -m "feat: prepare project for Vercel and Supabase deployment"
   git push origin main
   ```
2. Buka dashboard [Vercel](https://vercel.com) > Klik **Add New...** > **Project**.
3. Pilih repositori GitHub proyek kamu dan klik **Import**.
4. **LANGKAH PALING KRUSIAL (Application Preset)**:
   - Pada dropdown **Application Preset**, jika otomatis terpilih **Vite**, klik dropdown tersebut lalu ubah menjadi **Other**.
   - *(Jika dibiarkan "Vite", Vercel mengira aplikasi hanyalah frontend statis biasa, bukan backend Laravel PHP).*
5. **Isi Environment Variables**:
   Buka accordion **Environment Variables** dan tambahkan variabel-variabel berikut:

   | Key | Contoh Value | Keterangan |
   | :--- | :--- | :--- |
   | `APP_NAME` | `E-Report` | Nama aplikasi kamu |
   | `APP_ENV` | `production` | Lingkungan aplikasi |
   | `APP_KEY` | `base64:xxxxxxx...` | Salin nilai `APP_KEY` dari file `.env` lokalmu |
   | `APP_DEBUG` | `false` | Matikan debug mode untuk keamanan |
   | `DB_CONNECTION` | `pgsql` | Driver database PostgreSQL |
   | `DB_HOST` | `aws-0-[region].pooler.supabase.com` | Host Connection Pooler Supabase |
   | `DB_PORT` | `5432` | Port pooler Supabase |
   | `DB_DATABASE` | `postgres` | Nama database Supabase |
   | `DB_USERNAME` | `postgres.[PROJECT_REF]` | Username Supabase |
   | `DB_PASSWORD` | `PasswordSupabaseKamu` | Password database Supabase |
   | `DB_SSLMODE` | `require` | Enkripsi SSL Supabase |
   | `SESSION_DRIVER` | `cookie` atau `database` | `cookie` atau `database` (karena ada tabel sessions) |
   | `CACHE_STORE` | `array` | Cache memory untuk serverless |
   | `ADMIN_EMAIL` | `admin@ereport.test` | Email admin awal (opsional) |
   | `ADMIN_PASSWORD` | `admin123` | Password admin awal (opsional) |

   > **Tips Cepat**: Di Vercel, kamu bisa meng-copy seluruh baris `.env` di atas dan mem-paste-kannya langsung di kotak isian "Key" pertama. Vercel akan otomatis memecah setiap baris menjadi variabel terpisah!

6. Klik tombol **Deploy**!
7. Tunggu proses build selesai (~30-60 detik). Setelah selesai, klik URL domain Vercel yang diberikan. Selamat, aplikasi Laravel kamu sudah online!

---

## Troubleshooting & Solusi Masalah Umum

### 1. HTTP 500 Server Error saat Login: "This password does not use the Bcrypt algorithm"
- **Penyebab**: Mengubah password langsung lewat Supabase Table Editor atau SQL eksternal menghasilkan hash dengan prefix `$2a$`. PHP Bcrypt di Laravel secara default mewajibkan prefix `$2y$`.
- **Solusi**: Selalu buat hash password menggunakan hashing Laravel:
  ```bash
  php artisan tinker
  App\Models\User::where('email', 'admin@example.com')->update(['password' => Hash::make('passwordBaru')]);
  ```

### 2. Password Muncul di URL Address Bar (`/login?password=...`)
- **Penyebab**: Script Livewire terblokir atau belum termuat, dan tag `<form>` tidak memiliki atribut `method="POST"`.
- **Solusi**: Tambahkan `method="POST" action="#"` dan `@csrf` di setiap form Blade. Pastikan aset Livewire sudah di-publish (`php artisan livewire:publish --assets`).

### 3. Mixed Content Error (Script Diblokir Browser)
- **Penyebab**: Halaman dibuka di `https://`, tetapi Laravel men-generate link `http://`.
- **Solusi**: Pastikan `$middleware->trustProxies(at: '*')` ada di `bootstrap/app.php` dan `URL::forceScheme('https')` ada di `AppServiceProvider.php`.

### 4. Database Timeout / "could not translate host name"
- **Penyebab**: Provider internet tidak mendukung rute IPv6 murni saat mengakses direct host `db.xxxx.supabase.co`.
- **Solusi**: Ubah `DB_HOST` ke host **Connection Pooler** Supabase (`aws-0-[region].pooler.supabase.com`) dan pastikan `DB_USERNAME` berformat `postgres.[PROJECT_REF]`.

---

*Disusun dengan ❤️ untuk mempermudah deployment Laravel di platform modern serverless.*
