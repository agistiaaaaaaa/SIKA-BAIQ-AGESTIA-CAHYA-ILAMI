# Sika — Sistem Informasi Kemahasiswaan STMIK Lombok

Project CRUD sederhana buat ngelola data mahasiswa di kampus STMIK Lombok (Praya, Lombok Tengah). Tampilan clean, warna utama kuning kampus, dan akses aman: admin pegang kendali, mahasiswa bisa update datanya sendiri.

## Fitur Utama
- Daftar, detail, tambah, edit, hapus data mahasiswa (admin).
- Akun mahasiswa otomatis dibuat saat admin menambah data.
  - Default email: `NIM@sika.local`.
  - Default password: `NIM` (bisa diubah oleh admin).
- Mahasiswa bisa mengedit data miliknya sendiri (nama, prodi, alamat, foto) tanpa bisa mengubah NIM atau akun.
- Pagination 6 data per halaman di daftar admin, ada tombol Prev/Next.
- Beranda informatif bertema kuning STMIK Lombok.

## Teknologi
- Laravel 10+ (Blade, Eloquent, Auth dasar)
- Bootstrap (styling ringan)

## Setup Cepat (Dev Lokal)
1. Clone repo dan masuk folder project.
2. Duplikasi `.env.example` menjadi `.env` lalu isi:
   - `APP_NAME="Sika STMIK Lombok"`
   - Biarkan `DB_CONNECTION=sqlite` untuk setup cepat.
3. Buat file database SQLite: `database/database.sqlite` (file kosong).
4. Generate key dan jalankan migrasi + seeder:
   - `php artisan key:generate`
   - `php artisan migrate --seed`
5. Jalankan server dev: `php artisan serve`
6. Akses: `http://127.0.0.1:8000/`

### Opsi: MySQL/MariaDB
Kalau mau pakai MySQL:
- Ubah `.env` ke `DB_CONNECTION=mysql` dan sesuaikan `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
- Bisa pakai helper `create_db.php` atau `setup_sika.sql` untuk menyiapkan database dan user.
- Setelah itu jalankan `php artisan migrate --seed`.

## Akun Bawaan
- Admin: email `admin@sika.local`, password `admin123`.
- Mahasiswa: dibuat otomatis saat admin tambah data (email & password default dari NIM).

## Alur Penggunaan
- Admin login → kelola data mahasiswa (tambah, edit, hapus). Saat tambah data, isi NIM dan identitas; email/password akun bisa auto dari NIM atau diubah.
- Mahasiswa login → diarahkan melihat data miliknya; tombol Edit muncul untuk memperbarui nama/prodi/alamat/foto.
- Halaman daftar admin: 6 item per halaman, tombol Prev/Next untuk navigasi.

## Struktur Penting
- `app/Http/Controllers/MahasiswaController.php`: logika CRUD + sinkron akun user.
- `resources/views/mahasiswa/*`: tampilan daftar/detail/create/edit.
- `resources/views/home.blade.php`: Beranda kampus.
- `database/seeders/*`: admin dan data mahasiswa contoh.

## Catatan
- Registrasi lewat form publik dimatikan; akun mahasiswa dibuat oleh admin.
- Password mahasiswa default = NIM, tapi sebaiknya diganti oleh admin.

## Lisensi
Proyek ini memakai basis Laravel (MIT). Konten aplikasi Sika bebas dipakai untuk pembelajaran dan pengembangan internal kampus.
