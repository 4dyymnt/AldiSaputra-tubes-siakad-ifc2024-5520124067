# Panduan Instalasi SIAKAD

## Prasyarat
- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Node.js (opsional, untuk asset build)

---

## Langkah Instalasi

### 1. Buat Project Laravel Baru
```bash
composer create-project laravel/laravel tubes-siakad
cd tubes-siakad
```

### 2. Salin File Proyek
Copy semua file dari source code ini ke dalam folder project Laravel Anda, sesuaikan strukturnya:

```
app/
  Http/
    Controllers/   <- salin semua *Controller.php
    Middleware/    <- salin RoleMiddleware.php
  Models/          <- salin semua Model (User.php, Dosen.php, dst)

database/
  migrations/      <- salin semua file migration
  seeders/         <- salin DatabaseSeeder.php

resources/views/   <- salin semua folder views (auth, layouts, dosen, dst)

routes/
  web.php          <- salin/timpa web.php

bootstrap/
  app.php          <- salin app.php (untuk Laravel 11)
```

### 3. Konfigurasi .env
```env
APP_NAME="SIAKAD"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siakad
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database
```sql
CREATE DATABASE siakad CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Install Dependencies & Setup
```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

---

## Registrasi Middleware (Laravel 10)
Jika menggunakan **Laravel 10**, tambahkan di `app/Http/Kernel.php`:
```php
protected $middlewareAliases = [
    // ... existing
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];
```

Jika menggunakan **Laravel 11**, gunakan `bootstrap/app.php` yang sudah disediakan.

---

## Akun Login Default

| Role      | Email                              | Password  |
|-----------|------------------------------------|-----------|
| Admin     | admin@siakad.ac.id                 | password  |
| Mahasiswa | andi.prasetyo@mahasiswa.ac.id      | password  |
| Mahasiswa | bela.sari@mahasiswa.ac.id          | password  |
| Mahasiswa | candra.wijaya@mahasiswa.ac.id      | password  |

---

## Fitur yang Tersedia

### Admin
- [x] Dashboard statistik (total dosen, mahasiswa, matkul, KRS)
- [x] CRUD Dosen (+ pencarian)
- [x] CRUD Mahasiswa (+ pencarian)
- [x] CRUD Mata Kuliah (+ pencarian)
- [x] CRUD Jadwal (+ filter hari)
- [x] Lihat rekap KRS semua mahasiswa
- [x] Detail KRS per mahasiswa

### Mahasiswa
- [x] Dashboard personal (NPM, jumlah MK, total SKS)
- [x] Ambil mata kuliah (input KRS)
- [x] Drop mata kuliah
- [x] Lihat jadwal perkuliahan per hari
- [x] Validasi batas SKS (max 24)

---

## Struktur Folder Views

```
resources/views/
├── auth/
│   └── login.blade.php
├── layouts/
│   └── app.blade.php
├── dashboard/
│   ├── admin.blade.php
│   └── mahasiswa.blade.php
├── dosen/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── mahasiswa/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── matakuliah/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── jadwal/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   ├── show.blade.php
│   └── mahasiswa.blade.php
└── krs/
    ├── index.blade.php
    ├── admin.blade.php
    └── detail.blade.php
```
