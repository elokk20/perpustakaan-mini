# RuangFT.

**RuangFT.** adalah aplikasi web manajemen koleksi buku berbasis Laravel untuk proyek pembelajaran mata kuliah Pemrograman Web. Proyek ini merupakan karya pembelajaran, **bukan layanan resmi universitas hasanuddin**.

Aplikasi memungkinkan pengunjung menjelajahi dan mencari koleksi buku. Pengguna yang telah login dapat menambahkan, mengubah, dan menghapus data buku.

## Teknologi

- PHP dan **Laravel 12** (arsitektur MVC)
- **Laravel Blade** untuk halaman antarmuka
- **Tailwind CSS 4** serta CSS kustom RuangFT.
- **Vite** untuk memproses aset CSS/JavaScript
- **SQLite** untuk database lokal, melalui Eloquent ORM

## Fitur

| Fitur | Keterangan |
| --- | --- |
| Katalog buku | Menampilkan informasi judul, penulis, tahun, penerbit (jika ada), dan sampul ilustratif |
| Detail buku | Menampilkan informasi dan sinopsis buku |
| CRUD buku | Tambah, ubah, dan hapus data bagi pengguna yang login |
| Pencarian | Mencari buku berdasarkan judul atau penulis |
| Pagination | Maksimal lima buku per halaman |
| Validasi | Validasi server-side dan pesan kesalahan berbahasa Indonesia |
| Notifikasi | Pesan keberhasilan setelah tambah, ubah, atau hapus |
| Autentikasi | Login/logout berbasis session Laravel; route pengelolaan dilindungi middleware `auth` |
| Desain responsif | Katalog berbentuk kartu yang dapat digunakan di desktop dan mobile |
| Seeder | Menambahkan enam buku contoh untuk pengujian |

## Hak Akses

- **Pengunjung:** melihat katalog, mencari buku, dan membuka detail buku.
- **Pengguna login:** melakukan seluruh aktivitas pengunjung serta menambah, mengubah, dan menghapus buku.

Pendaftaran akun publik tidak tersedia pada versi ini. Akun dibuat secara lokal menggunakan perintah Artisan khusus proyek.

## Persyaratan

- PHP yang kompatibel dengan Laravel 12 beserta ekstensi yang dibutuhkan, terutama `fileinfo`, `zip`, `pdo_sqlite`, dan `sqlite3`
- Composer
- Node.js dan npm
- Git (opsional untuk pengembangan lokal; diperlukan untuk mengunggah kode ke GitHub)

## Cara Menjalankan Secara Lokal (Windows PowerShell)

1. Unduh/clone repositori dan buka terminal di folder proyek, yaitu folder yang memiliki file `artisan`.
2. Instal dependensi backend:

   ```powershell
   composer install
   ```

3. Buat konfigurasi lokal dari contoh jika belum tersedia:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

4. Pada `.env`, gunakan `APP_NAME="RuangFT"`, `APP_LOCALE=id`, dan `DB_CONNECTION=sqlite`. Siapkan file database jika belum tersedia:

   ```powershell
   if (-not (Test-Path .\database\database.sqlite)) {
       New-Item -ItemType File .\database\database.sqlite
   }
   php artisan config:clear
   php artisan migrate
   ```

5. Untuk data contoh pada instalasi baru, jalankan sekali:

   ```powershell
   php artisan db:seed --class=BukuSeeder
   ```

6. Buat akun untuk login melalui perintah interaktif:

   ```powershell
   php artisan ruangft:akun-buat
   ```

   Masukkan nama, email, dan kata sandi pribadi. Jangan menaruh kredensial di dalam repositori.

7. Instal dependensi frontend:

   ```powershell
   npm.cmd install
   ```

8. Jalankan aplikasi di **dua terminal** yang sama-sama berada di folder proyek:

   **Terminal 1:**
   ```powershell
   php artisan serve
   ```

   **Terminal 2:**
   ```powershell
   npm.cmd run dev
   ```

9. Buka `http://127.0.0.1:8000/buku` untuk katalog atau `http://127.0.0.1:8000/login` untuk login.

> **Catatan:** SQLite lokal dan file `.env` tidak disertakan dalam GitHub. Jalankan migration dan seeder pada instalasi baru. Jangan menjalankan `migrate:fresh` pada database yang berisi data yang ingin dipertahankan.

## Pengujian

Pengujian dilakukan pada implementasi lokal menggunakan fitur Laravel dan pemeriksaan antarmuka.

```powershell
php artisan test
npm.cmd run build
```

Skenario manual mencakup login dan logout, perlindungan route CRUD, tambah/edit/hapus buku, validasi input, pencarian, pagination, serta tampilan responsif.

Untuk pengujian otomatis yang menggunakan `RefreshDatabase`, konfigurasi database di `phpunit.xml` harus menggunakan SQLite `:memory:` agar tidak mengubah database utama.

## Struktur Proyek Utama

```text
app/
  Console/Commands/CreateRuangFtUser.php
  Http/Controllers/Auth/LoginController.php
  Http/Controllers/BukuController.php
  Models/Buku.php
database/
  migrations/
  seeders/BukuSeeder.php
resources/
  css/app.css
  css/auth-ruangft.css
  views/auth/login.blade.php
  views/buku/
  views/components/
  views/layouts/app.blade.php
routes/web.php
tests/Feature/
```

Folder `vendor`, `node_modules`, dan file konfigurasi rahasia tidak termasuk dalam repository.

## Dokumentasi Tampilan

Tangkapan layar hasil pengujian dalam folder `docs/screenshots/`, seperti:

- `01-katalog.png`
- `02-detail.png`
- `03-tambah.png`
- `04-edit.png`
- `05-pencarian.png`
- `06-login.png`
- `07-mobile.png`

## Konteks Tugas

Dikembangkan sebagai latihan penerapan Laravel, Blade, Tailwind CSS, MVC, migration, Eloquent ORM, resource controller, validasi, pagination, dan autentikasi pada mata kuliah Pemrograman Web.
