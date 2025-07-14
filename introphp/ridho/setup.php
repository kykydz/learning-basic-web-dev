<?php
/**
 * Setup Database Otomatis
 * Script untuk membuat database dan tabel secara otomatis
 */

// Include konfigurasi
require_once 'config.php';

// Fungsi untuk menjalankan setup database
function setupDatabase() {
    $setup_results = [];
    
    try {
        // Koneksi ke MySQL tanpa database spesifik
        $conn = new mysqli("localhost", "root", "");
        
        if ($conn->connect_error) {
            throw new Exception("Koneksi ke MySQL gagal: " . $conn->connect_error);
        }
        
        $setup_results[] = "✅ Koneksi ke MySQL berhasil";
        
        // Buat database
        $sql = "CREATE DATABASE IF NOT EXISTS mahasiswa_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if ($conn->query($sql)) {
            $setup_results[] = "✅ Database 'mahasiswa_db' berhasil dibuat/sudah ada";
        } else {
            throw new Exception("Gagal membuat database: " . $conn->error);
        }
        
        // Pilih database
        $conn->select_db("mahasiswa_db");
        $setup_results[] = "✅ Database 'mahasiswa_db' dipilih";
        
        // Buat tabel mahasiswa
        $sql = "CREATE TABLE IF NOT EXISTS mahasiswa (
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
        ) ENGINE=InnoDB";
        
        if ($conn->query($sql)) {
            $setup_results[] = "✅ Tabel 'mahasiswa' berhasil dibuat";
        } else {
            throw new Exception("Gagal membuat tabel mahasiswa: " . $conn->error);
        }
        
        // Buat tabel log
        $sql = "CREATE TABLE IF NOT EXISTS log_mahasiswa (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mahasiswa_id INT,
            aksi ENUM('INSERT', 'UPDATE', 'DELETE'),
            data_lama JSON,
            data_baru JSON,
            tanggal_log TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            user_agent TEXT,
            ip_address VARCHAR(45)
        ) ENGINE=InnoDB";
        
        if ($conn->query($sql)) {
            $setup_results[] = "✅ Tabel 'log_mahasiswa' berhasil dibuat";
        } else {
            $setup_results[] = "⚠️ Gagal membuat tabel log: " . $conn->error;
        }
        
        // Insert data contoh jika tabel kosong
        $result = $conn->query("SELECT COUNT(*) as total FROM mahasiswa");
        $count = $result->fetch_assoc()['total'];
        
        if ($count == 0) {
            $sample_data = [
                ['2024001', 'Ahmad Rizki Pratama', 'ahmad.rizki@email.com', 'Teknik Informatika', 2024],
                ['2024002', 'Siti Nurhaliza', 'siti.nurhaliza@email.com', 'Sistem Informasi', 2024],
                ['2023001', 'Budi Santoso', 'budi.santoso@email.com', 'Teknik Komputer', 2023],
                ['2023002', 'Dewi Lestari', 'dewi.lestari@email.com', 'Manajemen Informatika', 2023],
                ['2022001', 'Eko Prasetyo', 'eko.prasetyo@email.com', 'Teknik Elektro', 2022]
            ];
            
            $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan) VALUES (?, ?, ?, ?, ?)");
            
            foreach ($sample_data as $data) {
                $stmt->bind_param("ssssi", $data[0], $data[1], $data[2], $data[3], $data[4]);
                $stmt->execute();
            }
            
            $setup_results[] = "✅ Data contoh berhasil ditambahkan (" . count($sample_data) . " record)";
        } else {
            $setup_results[] = "ℹ️ Tabel sudah berisi " . $count . " record data";
        }
        
        $conn->close();
        
        return [
            'status' => true,
            'message' => 'Setup database berhasil!',
            'details' => $setup_results
        ];
        
    } catch (Exception $e) {
        return [
            'status' => false,
            'message' => 'Setup database gagal: ' . $e->getMessage(),
            'details' => $setup_results
        ];
    }
}

// Jika diakses langsung via browser
if (isset($_GET['setup']) || (php_sapi_name() !== 'cli' && basename($_SERVER['PHP_SELF']) === 'setup.php')) {
    $result = setupDatabase();
    
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Setup Database - Sistem Manajemen Mahasiswa</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .container {
                background: white;
                padding: 40px;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 600px;
                animation: slideUp 0.6s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .header {
                text-align: center;
                margin-bottom: 30px;
            }

            .success {
                color: #28a745;
            }

            .error {
                color: #dc3545;
            }

            .icon {
                font-size: 60px;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 28px;
                margin-bottom: 10px;
            }

            .details {
                background: #f8f9fa;
                border-radius: 10px;
                padding: 20px;
                margin: 20px 0;
                text-align: left;
            }

            .details ul {
                list-style: none;
                padding: 0;
            }

            .details li {
                margin: 10px 0;
                padding: 5px 0;
            }

            .btn {
                display: inline-block;
                padding: 12px 25px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                text-decoration: none;
                border-radius: 10px;
                font-weight: 600;
                margin: 10px 5px;
                transition: all 0.3s ease;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            }

            .btn-secondary {
                background: #6c757d;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="icon <?php echo $result['status'] ? 'success' : 'error'; ?>">
                    <?php echo $result['status'] ? '✅' : '❌'; ?>
                </div>
                <h1 class="<?php echo $result['status'] ? 'success' : 'error'; ?>">
                    <?php echo $result['message']; ?>
                </h1>
            </div>
            
            <?php if (!empty($result['details'])): ?>
                <div class="details">
                    <h3>Detail Setup:</h3>
                    <ul>
                        <?php foreach ($result['details'] as $detail): ?>
                            <li><?php echo htmlspecialchars($detail); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div style="text-align: center;">
                <?php if ($result['status']): ?>
                    <a href="form.html" class="btn">📝 Mulai Input Data</a>
                    <a href="tampil_data.php" class="btn btn-secondary">📋 Lihat Data</a>
                <?php else: ?>
                    <a href="?setup=1" class="btn">🔄 Coba Lagi</a>
                <?php endif; ?>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Jika dipanggil dari command line
if (php_sapi_name() === 'cli') {
    echo "🚀 Memulai setup database...\n\n";
    
    $result = setupDatabase();
    
    echo $result['message'] . "\n\n";
    
    if (!empty($result['details'])) {
        echo "Detail:\n";
        foreach ($result['details'] as $detail) {
            echo "  " . $detail . "\n";
        }
    }
    
    echo "\n" . ($result['status'] ? "✅ Setup selesai!" : "❌ Setup gagal!") . "\n";
}
?>

