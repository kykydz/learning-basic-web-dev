-- Script SQL untuk membuat database dan tabel mahasiswa
-- Jalankan script ini di MySQL/MariaDB

-- Membuat database
CREATE DATABASE IF NOT EXISTS mahasiswa_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Menggunakan database
USE mahasiswa_db;

-- Membuat tabel mahasiswa dengan struktur yang lebih lengkap
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    jurusan VARCHAR(50) NOT NULL,
    angkatan YEAR NOT NULL,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tanggal_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('aktif', 'non-aktif', 'lulus') DEFAULT 'aktif',
    INDEX idx_nim (nim),
    INDEX idx_nama (nama),
    INDEX idx_jurusan (jurusan),
    INDEX idx_angkatan (angkatan),
    INDEX idx_status (status)
) ENGINE=InnoDB;

-- Menambahkan beberapa data contoh (opsional)
INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan) VALUES
('2024001', 'Ahmad Rizki Pratama', 'ahmad.rizki@email.com', 'Teknik Informatika', 2024),
('2024002', 'Siti Nurhaliza', 'siti.nurhaliza@email.com', 'Sistem Informasi', 2024),
('2023001', 'Budi Santoso', 'budi.santoso@email.com', 'Teknik Komputer', 2023),
('2023002', 'Dewi Lestari', 'dewi.lestari@email.com', 'Manajemen Informatika', 2023),
('2022001', 'Eko Prasetyo', 'eko.prasetyo@email.com', 'Teknik Elektro', 2022)
ON DUPLICATE KEY UPDATE nim = nim; -- Mencegah error jika data sudah ada

-- Membuat view untuk statistik
CREATE OR REPLACE VIEW v_statistik_mahasiswa AS
SELECT 
    COUNT(*) as total_mahasiswa,
    COUNT(DISTINCT jurusan) as total_jurusan,
    COUNT(DISTINCT angkatan) as total_angkatan,
    COUNT(CASE WHEN DATE(tanggal_daftar) = CURDATE() THEN 1 END) as pendaftar_hari_ini,
    COUNT(CASE WHEN status = 'aktif' THEN 1 END) as mahasiswa_aktif,
    COUNT(CASE WHEN status = 'lulus' THEN 1 END) as mahasiswa_lulus
FROM mahasiswa;

-- Membuat stored procedure untuk backup data
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS BackupMahasiswa()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE backup_table_name VARCHAR(100);
    
    SET backup_table_name = CONCAT('mahasiswa_backup_', DATE_FORMAT(NOW(), '%Y%m%d_%H%i%s'));
    
    SET @sql = CONCAT('CREATE TABLE ', backup_table_name, ' AS SELECT * FROM mahasiswa');
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
    
    SELECT CONCAT('Backup berhasil dibuat dengan nama tabel: ', backup_table_name) as message;
END //
DELIMITER ;

-- Membuat trigger untuk log perubahan
CREATE TABLE IF NOT EXISTS log_mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_id INT,
    aksi ENUM('INSERT', 'UPDATE', 'DELETE'),
    data_lama JSON,
    data_baru JSON,
    tanggal_log TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_agent TEXT,
    ip_address VARCHAR(45)
) ENGINE=InnoDB;

DELIMITER //
CREATE TRIGGER IF NOT EXISTS tr_mahasiswa_after_insert
AFTER INSERT ON mahasiswa
FOR EACH ROW
BEGIN
    INSERT INTO log_mahasiswa (mahasiswa_id, aksi, data_baru)
    VALUES (NEW.id, 'INSERT', JSON_OBJECT(
        'nim', NEW.nim,
        'nama', NEW.nama,
        'email', NEW.email,
        'jurusan', NEW.jurusan,
        'angkatan', NEW.angkatan,
        'status', NEW.status
    ));
END //

CREATE TRIGGER IF NOT EXISTS tr_mahasiswa_after_update
AFTER UPDATE ON mahasiswa
FOR EACH ROW
BEGIN
    INSERT INTO log_mahasiswa (mahasiswa_id, aksi, data_lama, data_baru)
    VALUES (NEW.id, 'UPDATE', 
        JSON_OBJECT(
            'nim', OLD.nim,
            'nama', OLD.nama,
            'email', OLD.email,
            'jurusan', OLD.jurusan,
            'angkatan', OLD.angkatan,
            'status', OLD.status
        ),
        JSON_OBJECT(
            'nim', NEW.nim,
            'nama', NEW.nama,
            'email', NEW.email,
            'jurusan', NEW.jurusan,
            'angkatan', NEW.angkatan,
            'status', NEW.status
        )
    );
END //

CREATE TRIGGER IF NOT EXISTS tr_mahasiswa_after_delete
AFTER DELETE ON mahasiswa
FOR EACH ROW
BEGIN
    INSERT INTO log_mahasiswa (mahasiswa_id, aksi, data_lama)
    VALUES (OLD.id, 'DELETE', JSON_OBJECT(
        'nim', OLD.nim,
        'nama', OLD.nama,
        'email', OLD.email,
        'jurusan', OLD.jurusan,
        'angkatan', OLD.angkatan,
        'status', OLD.status
    ));
END //
DELIMITER ;

-- Menampilkan informasi database yang telah dibuat
SELECT 'Database mahasiswa_db berhasil dibuat!' as status;
SELECT * FROM v_statistik_mahasiswa;
SHOW TABLES;

