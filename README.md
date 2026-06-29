# SIAKAD - Sistem Informasi Akademik Sederhana

Aplikasi web berbasis **Laravel** yang mensimulasikan Sistem Informasi Akademik (SIAKAD) sederhana. Dibangun sebagai Tugas Besar Mata Kuliah Web II (IF53413).

---

## 🚀 Fitur Utama

- **Authentication & Authorization** dengan 2 role: Admin dan Mahasiswa
- **CRUD Dosen** — Tambah, edit, hapus, lihat data dosen
- **CRUD Mahasiswa** — Tambah, edit, hapus, lihat data mahasiswa
- **CRUD Mata Kuliah** — Tambah, edit, hapus, lihat daftar mata kuliah
- **CRUD Jadwal** — Manajemen jadwal perkuliahan (dosen, hari, jam, kelas)
- **KRS (Kartu Rencana Studi)** — Mahasiswa dapat mengambil dan drop mata kuliah
- **Dashboard Statistik** — Ringkasan data untuk admin dan mahasiswa
- **Pencarian & Filter** — Pada setiap halaman tabel data

---

## 🛠️ Teknologi

| Stack | Versi |
|-------|-------|
| PHP | >= 8.2 |
| Laravel | 11.x |
| MySQL | 8.x |
| Bootstrap | 5.3 |

---

## ⚙️ Instalasi

```bash
# 1. Clone repository
git clone https://github.com/[username]/[nama-repo].git
cd [nama-repo]

# 2. Install dependencies
composer install

# 3. Copy file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di .env
# DB_DATABASE=siakad
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migrasi dan seeder
php artisan migrate --seed

# 7. Jalankan server
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

---

## 👤 Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@siakad.ac.id | password |
| Mahasiswa | andi.prasetyo@mahasiswa.ac.id | password |
| Mahasiswa | bela.sari@mahasiswa.ac.id | password |

---

## 📄 Penjelasan Halaman

| Halaman | Role | Fungsi |
|---------|------|--------|
| `/login` | Semua | Halaman login |
| `/dashboard` | Semua | Dashboard statistik sesuai role |
| `/dosen` | Admin | CRUD data dosen |
| `/mahasiswa` | Admin | CRUD data mahasiswa |
| `/matakuliah` | Admin | CRUD data mata kuliah |
| `/jadwal` | Admin | CRUD jadwal perkuliahan |
| `/krs` | Admin | Rekap KRS seluruh mahasiswa |
| `/my-krs` | Mahasiswa | Ambil & drop mata kuliah |
| `/jadwal-view` | Mahasiswa | Lihat jadwal perkuliahan |

---

## 🗄️ Struktur Database (ERD)

```
dosen          mahasiswa
 - nidn (PK)    - npm (PK)
 - nama         - nama

matakuliah     jadwal                  krs
 - kode (PK)    - id (PK)              - id (PK)
 - nama         - kode_matakuliah (FK) - npm (FK)
 - sks          - nidn (FK)            - kode_matakuliah (FK)
                - kelas
                - hari
                - jam
```

---

## 📸 Screenshots

Lihat folder [`screenshots/`](./screenshots/) untuk tampilan setiap halaman.

---

## 🌐 Link Hosting

> *(Isi dengan link hosting jika sudah di-deploy)*

---

## 📝 Catatan Teknis

- Middleware `role` digunakan untuk membatasi akses halaman berdasarkan role user
- Semua form dilengkapi validasi Laravel
- Eloquent Relationship digunakan antar semua model
- Seeder menyediakan data awal: 3 dosen, 3 mahasiswa, 5 mata kuliah, 3 jadwal
- Password default mahasiswa baru = NPM mahasiswa
# AldiSaputra-tubes-siakad-ifc2024-5520124067
