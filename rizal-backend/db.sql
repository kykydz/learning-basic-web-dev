-- 1. Membuat database library_db
CREATE DATABASE library_db;

-- 2. Menggunakan database yang baru dibuat
USE library_db;

-- 3. Membuat tabel visitors untuk menyimpan data pengunjung
CREATE TABLE visitors (
  id INT AUTO_INCREMENT PRIMARY KEY,  -- ID pengunjung, auto increment
  name VARCHAR(100) NOT NULL,         -- Nama pengunjung
  address TEXT NOT NULL,              -- Alamat pengunjung
  phone_number VARCHAR(20) NOT NULL,  -- Nomor telepon pengunjung
  visit_date DATE NOT NULL            -- Tanggal kunjungan pengunjung
);

-- 4. Menambahkan contoh data pengunjung
INSERT INTO visitors (name, address, phone_number, visit_date) VALUES
('John Doe', 'Jl. Merdeka No.1', '08123456789', '2025-07-17'),
('Jane Smith', 'Jl. Raya No.2', '08234567890', '2025-07-16'),
('Alice Johnson', 'Jl. Kebon Jeruk No.3', '08345678901', '2025-07-15');

-- 5. Menampilkan semua data pengunjung yang ada di tabel visitors
SELECT * FROM visitors;
