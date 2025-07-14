<?php

class DatabaseConfig {
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $database = "mahasiswa_db";
    private static $charset = "utf8mb4";
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                self::$connection = new mysqli(
                    self::$host,
                    self::$username,
                    self::$password,
                    self::$database
                );

                self::$connection->set_charset(self::$charset);

                if (self::$connection->connect_error) {
                    throw new Exception("Koneksi database gagal: " . self::$connection->connect_error);
                }

                self::$connection->query("SET time_zone = '+07:00'");
            } catch (Exception $e) {
                error_log("Database Connection Error: " . $e->getMessage());
                die("Koneksi database gagal. Silakan coba lagi nanti.");
            }
        }

        return self::$connection;
    }

    public static function closeConnection() {
        if (self::$connection !== null) {
            self::$connection->close();
            self::$connection = null;
        }
    }

    public static function checkDatabaseSetup() {
        try {
            $conn = self::getConnection();

            $result = $conn->query("SHOW TABLES LIKE 'mahasiswa'");
            if ($result->num_rows == 0) {
                return [
                    'status' => false,
                    'message' => 'Tabel mahasiswa belum dibuat. Silakan jalankan script database.sql terlebih dahulu.'
                ];
            }

            $result = $conn->query("DESCRIBE mahasiswa");
            $columns = [];
            while ($row = $result->fetch_assoc()) {
                $columns[] = $row['Field'];
            }

            $required_columns = ['id', 'nim', 'nama', 'email', 'jurusan', 'angkatan', 'tanggal_daftar'];
            $missing_columns = array_diff($required_columns, $columns);

            if (!empty($missing_columns)) {
                return [
                    'status' => false,
                    'message' => 'Struktur tabel tidak lengkap. Kolom yang hilang: ' . implode(', ', $missing_columns)
                ];
            }

            return [
                'status' => true,
                'message' => 'Database setup sudah benar'
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Error saat mengecek database: ' . $e->getMessage()
            ];
        }
    }

    public static function executeQuery($sql, $params = [], $types = '') {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Prepare statement gagal: " . $conn->error);
            }

            if (!empty($params)) {
                if (empty($types)) {
                    $types = str_repeat('s', count($params));
                }
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();

            if ($stmt->error) {
                throw new Exception("Execute query gagal: " . $stmt->error);
            }

            return $stmt;
        } catch (Exception $e) {
            error_log("Database Query Error: " . $e->getMessage());
            throw $e;
        }
    }

    public static function getStatistics() {
        try {
            $conn = self::getConnection();
            $stats = [];

            $result = $conn->query("SELECT COUNT(*) as total FROM mahasiswa");
            $stats['total_mahasiswa'] = $result->fetch_assoc()['total'];

            $result = $conn->query("SELECT COUNT(DISTINCT jurusan) as total FROM mahasiswa");
            $stats['total_jurusan'] = $result->fetch_assoc()['total'];

            $result = $conn->query("SELECT COUNT(*) as total FROM mahasiswa WHERE DATE(tanggal_daftar) = CURDATE()");
            $stats['mahasiswa_hari_ini'] = $result->fetch_assoc()['total'];

            $result = $conn->query("SELECT jurusan, COUNT(*) as jumlah FROM mahasiswa GROUP BY jurusan ORDER BY jumlah DESC");
            $stats['per_jurusan'] = [];
            while ($row = $result->fetch_assoc()) {
                $stats['per_jurusan'][] = $row;
            }

            $result = $conn->query("SELECT angkatan, COUNT(*) as jumlah FROM mahasiswa GROUP BY angkatan ORDER BY angkatan DESC");
            $stats['per_angkatan'] = [];
            while ($row = $result->fetch_assoc()) {
                $stats['per_angkatan'][] = $row;
            }

            return $stats;
        } catch (Exception $e) {
            error_log("Database Statistics Error: " . $e->getMessage());
            return [];
        }
    }

    public static function backupData() {
        try {
            $conn = self::getConnection();
            $backup_filename = 'backup_mahasiswa_' . date('Y-m-d_H-i-s') . '.sql';
            $backup_path = __DIR__ . '/backups/' . $backup_filename;

            if (!is_dir(__DIR__ . '/backups/')) {
                mkdir(__DIR__ . '/backups/', 0755, true);
            }

            $result = $conn->query("SELECT * FROM mahasiswa ORDER BY id");
            $backup_content = "-- Backup Data Mahasiswa\n";
            $backup_content .= "-- Tanggal: " . date('Y-m-d H:i:s') . "\n\n";
            $backup_content .= "INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan, tanggal_daftar, status) VALUES\n";

            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = "('" . 
                    addslashes($row['nim']) . "', '" . 
                    addslashes($row['nama']) . "', '" . 
                    addslashes($row['email']) . "', '" . 
                    addslashes($row['jurusan']) . "', '" . 
                    $row['angkatan'] . "', '" . 
                    $row['tanggal_daftar'] . "', '" . 
                    ($row['status'] ?? 'aktif') . "')";
            }

            $backup_content .= implode(",\n", $rows) . ";\n";
            file_put_contents($backup_path, $backup_content);

            return [
                'status' => true,
                'message' => 'Backup berhasil dibuat',
                'filename' => $backup_filename,
                'path' => $backup_path
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Backup gagal: ' . $e->getMessage()
            ];
        }
    }
}

function getDB() {
    return DatabaseConfig::getConnection();
}

function checkDBSetup() {
    return DatabaseConfig::checkDatabaseSetup();
}

$db_check = DatabaseConfig::checkDatabaseSetup();
if (!$db_check['status']) {
    error_log("Database Setup Warning: " . $db_check['message']);
}