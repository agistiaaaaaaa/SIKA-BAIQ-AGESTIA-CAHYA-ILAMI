-- Setup database dan user untuk aplikasi Sika
CREATE DATABASE IF NOT EXISTS sika CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Buat user laravel dengan password dan pastikan plugin mysql_native_password
CREATE USER IF NOT EXISTS 'laravel'@'localhost' IDENTIFIED BY 'secret123';
ALTER USER 'laravel'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('secret123');

-- Beri hak akses penuh pada database sika
GRANT ALL PRIVILEGES ON sika.* TO 'laravel'@'localhost';
FLUSH PRIVILEGES;

-- Gunakan database sika
USE sika;

-- Buat tabel mahasiswas bila belum ada (sesuai kebutuhan aplikasi)
CREATE TABLE IF NOT EXISTS mahasiswas (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  nim VARCHAR(50) NOT NULL UNIQUE,
  nama VARCHAR(255) NOT NULL,
  prodi VARCHAR(255) NOT NULL,
  alamat TEXT NOT NULL,
  gambar VARCHAR(255) NULL,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

-- Isi 10 data awal (abaikan jika sudah ada nim yang sama)
INSERT IGNORE INTO mahasiswas (nim, nama, prodi, alamat, gambar) VALUES
('TI121212','Gunawan','Sistem Informasi','Mataram',NULL),
('TI121213','Putri','Teknik Informatika','Denpasar',NULL),
('TI121214','Budi','Teknik Komputer','Surabaya',NULL),
('TI121215','Sari','Ilmu Komputer','Bandung',NULL),
('TI121216','Andi','Sistem Informasi','Jakarta',NULL),
('TI121217','Dewi','Teknik Informatika','Bogor',NULL),
('TI121218','Rizky','Teknik Komputer','Yogyakarta',NULL),
('TI121219','Rina','Ilmu Komputer','Semarang',NULL),
('TI121220','Adi','Sistem Informasi','Malang',NULL),
('TI121221','Nina','Teknik Informatika','Makassar',NULL);

-- Verifikasi (opsional saat dijalankan manual)
-- SELECT user, host, plugin FROM mysql.user WHERE user IN ('laravel','root');