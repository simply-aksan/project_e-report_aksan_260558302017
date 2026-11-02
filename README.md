# E-Report — Sistem Informasi Pengaduan & Layanan Aspirasi Warga

> **Tugas Akhir Project Semester 1 — Program Studi Teknologi Rekayasa Perangkat Lunak (TRPL)**  
> **Mahasiswa:** Allam Permata Putra  
> **NIM:** 260558302016  
> **Repository GitHub:** [https://github.com/simply-aksan/e-report](https://github.com/simply-aksan/e-report)

---

## 📌 Deskripsi Singkat Project

**E-Report** adalah aplikasi berbasis web yang dirancang untuk memfasilitasi pelaporan keluhan, aspirasi, dan permasalahan lingkungan (seperti fasilitas umum, penerangan jalan, kebersihan, dan ketertiban) secara transparan, akuntabel, dan real-time.

Aplikasi ini membagi hak akses ke dalam dua peran utama:
1. **Warga (Pelapor):** Dapat mendaftarkan akun, mengirimkan laporan pengaduan dilengkapi bukti foto dan lokasi, memantau alur perkembangan status laporan (*Menunggu* → *Proses* → *Selesai*), serta mengubah/menghapus laporan selama belum diproses oleh petugas.
2. **Admin / Petugas:** Memiliki kendali penuh untuk meninjau seluruh data laporan warga, memverifikasi bukti di lapangan, dan memperbarui status tahapan penanganan secara transparan.

---

## 🚀 Fitur Utama

- **Autentikasi & Otorisasi Ketat:**
  - Registrasi mandiri warga dengan validasi identitas (nama, nomor kontak/WhatsApp, alamat).
  - Pembatasan rute dan proteksi data berbasis peran (*Role-Based Access Control*).
- **Manajemen Pengaduan (Warga):**
  - Form pelaporan responsif dengan upload berkas foto pendukung.
  - Tracking status pengaduan real-time (*Menunggu*, *Proses*, *Selesai*).
  - Fitur perbaikan dan pembatalan laporan milik sendiri selama status masih *Menunggu*.
- **Panel Pengelolaan (Admin):**
  - Dashboard statistik ringkasan total laporan, laporan menunggu, dalam proses, dan selesai.
  - Filter, pencarian kata kunci, dan penelusuran riwayat lengkap warga.
  - Alur perubahan status satu arah tanpa lompatan (*sequential state machine*).
- **Keamanan & Validasi:**
  - Sanitasi input dan proteksi data pribadi warga dari akses publik.
  - Pembatasan ukuran dan format file foto untuk mencegah eksploitasi upload.
  - Uji otomatis (*Automated Tests*) mencakup seluruh skenario fungsionalitas dan otorisasi.

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
| :--- | :--- |
| **Framework Backend** | [Laravel 12](https://laravel.com/) |
| **Bahasa Pemrograman** | [PHP 8.2+](https://www.php.net/) |
| **Komponen Reaktif** | [Livewire 4](https://livewire.laravel.com/) |
| **Styling & Tampilan** | [Tailwind CSS 4](https://tailwindcss.com/) |
| **Icon Pack** | [Lucide Icons](https://lucide.dev/) |
| **Database** | SQLite (standar pengembangan & testing) / MySQL |
| **Pengujian (Testing)** | PHPUnit / Laravel Test Suite (38 tests passed, 181 assertions) |

---

## 📁 Struktur Direktori Project

```text
e-report/
├── app/
│   ├── Livewire/             # Komponen interaktif Livewire (Auth, Warga, Admin)
│   ├── Models/               # Model Eloquent (User, Complaint)
│   └── Providers/            # Service providers aplikasi
├── config/                   # Konfigurasi aplikasi & admin credentials
├── database/
│   ├── migrations/           # Skema tabel database (users, complaints, sessions)
│   └── seeders/              # Database seeder (AdminSeeder)
├── docs/                     # File dokumentasi & aset antarmuka statis
├── public/                   # Asset publik & index.php
├── resources/
│   └── views/                # Template Blade, layouts (app, auth), & komponen UI
├── routes/
│   ├── web.php               # Rute web & otorisasi halaman
│   └── console.php           # Artisan command definitions
├── storage/                  # Berkas upload laporan warga & cache aplikasi
├── tests/
│   ├── Feature/              # Pengujian integrasi fungsional & otorisasi (EReportTest)
│   └── Unit/                 # Pengujian unit
└── README.md                 # Dokumentasi panduan project
```

---

## 💻 Langkah Menjalankan Project

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal:

### 1. Kloning Repository
```bash
git clone https://github.com/allam1768/project-E_Report-260558302016.git
cd project-E_Report-260558302016
```

### 2. Instalasi Dependensi PHP
```bash
composer install
```

### 3. Konfigurasi Environment File
Salin file konfigurasi environment dari template:
```bash
cp .env.example .env
```
Generate kunci aplikasi (*Application Key*):
```bash
php artisan key:generate
```

### 4. Setup Database & Migrasi
Secara default, project menggunakan basis data SQLite yang praktis tanpa memerlukan konfigurasi database server tambahan:
```bash
touch database/database.sqlite
```
Jalankan migrasi tabel beserta seeder akun administrator awal:
```bash
php artisan migrate --seed
```

> **Catatan:** Jika ingin menggunakan database MySQL, sesuaikan konfigurasi `DB_*` pada file `.env` terlebih dahulu sebelum menjalankan perintah migrasi.

### 5. Buat Symbolic Link Storage
Pastikan folder storage publik terhubung agar foto bukti laporan dapat ditampilkan dengan benar:
```bash
php artisan storage:link
```

### 6. Jalankan Server Aplikasi
Jalankan server lokal Laravel:
```bash
php artisan serve
```
Buka browser dan akses aplikasi melalui tautan:  
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🔑 Kredensial Akun Bawaan (Default Login)

Untuk keperluan pengujian asisten dosen / dosen penilai:

### Akun Administrator
- **Email:** `admin@ereport.test`
- **Password:** `Admin#Password123!`
- **Akses:** Meninjau semua laporan, mengubah status laporan (*Menunggu* → *Proses* → *Selesai*).

### Akun Warga
- Warga baru dapat langsung mendaftar melalui menu **Daftar / Registrasi** di halaman utama dengan nomor WhatsApp dan alamat yang valid.

---

## 🧪 Pengujian Otomatis (Automated Testing)

Project ini telah dilengkapi dengan 38 unit & feature tests terverifikasi untuk menjamin seluruh logika bisnis, otorisasi, proteksi input, dan integritas database berjalan tanpa celah.

Jalankan test suite menggunakan perintah:
```bash
php artisan test
```

Hasil uji:
```text
PASS  Tests\Unit\ExampleTest
PASS  Tests\Feature\EReportTest (36 tests)
PASS  Tests\Feature\ExampleTest
Tests:    38 passed (181 assertions)
```

---

## 📄 Lisensi & Hak Cipta

Project ini dikembangkan sebagai pemenuhan tugas akademik semester 1 mata kuliah pemrograman web / rekayasa perangkat lunak pada Program Studi Teknologi Rekayasa Perangkat Lunak (TRPL) Politeknik IDN.
