# CRUD Mahasiswa – PHP OOP dengan PDO

## Ringkasan
Aplikasi sederhana untuk mengelola data mahasiswa menggunakan operasi CRUD.  
Mendukung input teks, angka, pilihan, dan upload foto dengan validasi:
- Format file hanya JPG/PNG
- Ukuran maksimal 2MB
- File disimpan di folder `uploads/` dengan nama unik
- Path file disimpan di database

## Teknologi
- PHP 8.x
- MySQL/MariaDB
- PDO (PHP Data Objects)
- Server bawaan PHP (`php -S localhost:8000`)

## Struktur Direktori
- `/class` → berisi `Database.php`, `Mahasiswa.php`, `Utility.php`
- `/inc` → konfigurasi utama (`config.php`)
- `/css` → file gaya tampilan (`style.css`)
- `/uploads` → folder penyimpanan foto
- File utama: `index.php`, `members.php`, `create.php`, `edit.php`, `delete.php`
- Tambahan: `schema.sql`, `.gitignore`, `README.md`

## Cara Menjalankan
1. Import `schema.sql` ke MySQL.
2. Sesuaikan konfigurasi DB di `inc/config.php`.
3. Jalankan server:
   ```bash
   php -S localhost:8000
