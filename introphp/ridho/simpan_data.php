<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa_db";

try {
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8");
} catch (Exception $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama'] ?? '');
    $nim = trim($_POST['nim'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');
    $angkatan = trim($_POST['angkatan'] ?? '');
    
    $errors = [];
    
    if (empty($nama)) {
        $errors[] = "Nama tidak boleh kosong";
    }
    
    if (empty($nim)) {
        $errors[] = "NIM tidak boleh kosong";
    } elseif (!preg_match('/^\d+$/', $nim)) {
        $errors[] = "NIM harus berupa angka";
    }
    
    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    if (empty($jurusan)) {
        $errors[] = "Jurusan harus dipilih";
    }
    
    if (empty($angkatan)) {
        $errors[] = "Tahun angkatan harus dipilih";
    }
    
    if (!empty($errors)) {
        displayError($errors);
        exit;
    }
    
    $check_sql = "SELECT nim, email FROM mahasiswa WHERE nim = ? OR email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $nim, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        $existing = $check_result->fetch_assoc();
        if ($existing['nim'] == $nim) {
            displayError(["NIM sudah terdaftar dalam sistem"]);
        } else {
            displayError(["Email sudah terdaftar dalam sistem"]);
        }
        exit;
    }
    
    $sql = "INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan, tanggal_daftar) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nim, $nama, $email, $jurusan, $angkatan);
    
    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        $result = $conn->query("SELECT * FROM mahasiswa WHERE id = $last_id");
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            displaySuccess($row);
        } else {
            displayError(["Gagal mengambil data yang baru disimpan"]);
        }
    } else {
        displayError(["Gagal menyimpan data: " . $stmt->error]);
    }
    
    $stmt->close();
} else {
    displayError(["Metode request tidak valid"]);
}

$conn->close();

function displaySuccess($data) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Berhasil Disimpan</title>
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
                text-align: center;
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

            .success-icon {
                font-size: 60px;
                color: #28a745;
                margin-bottom: 20px;
            }

            h1 {
                color: #28a745;
                margin-bottom: 20px;
                font-size: 28px;
            }

            .data-card {
                background: #f8f9fa;
                border-radius: 15px;
                padding: 25px;
                margin: 25px 0;
                text-align: left;
            }

            .data-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 0;
                border-bottom: 1px solid #e9ecef;
            }

            .data-row:last-child {
                border-bottom: none;
            }

            .data-label {
                font-weight: 600;
                color: #495057;
                min-width: 120px;
            }

            .data-value {
                color: #212529;
                font-weight: 500;
            }

            .btn-group {
                display: flex;
                gap: 15px;
                justify-content: center;
                margin-top: 30px;
            }

            .btn {
                padding: 12px 25px;
                border: none;
                border-radius: 10px;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .btn-secondary {
                background: #6c757d;
                color: white;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            }

            @media (max-width: 480px) {
                .btn-group {
                    flex-direction: column;
                }
                
                .data-row {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 5px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="success-icon">✅</div>
            <h1>Data Berhasil Disimpan!</h1>
            <p>Data mahasiswa telah berhasil ditambahkan ke dalam sistem.</p>
            
            <div class="data-card">
                <div class="data-row">
                    <span class="data-label">NIM:</span>
                    <span class="data-value"><?php echo htmlspecialchars($data['nim']); ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">Nama:</span>
                    <span class="data-value"><?php echo htmlspecialchars($data['nama']); ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">Email:</span>
                    <span class="data-value"><?php echo htmlspecialchars($data['email']); ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">Jurusan:</span>
                    <span class="data-value"><?php echo htmlspecialchars($data['jurusan']); ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">Angkatan:</span>
                    <span class="data-value"><?php echo htmlspecialchars($data['angkatan']); ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">Tanggal Daftar:</span>
                    <span class="data-value"><?php echo date('d/m/Y H:i', strtotime($data['tanggal_daftar'])); ?></span>
                </div>
            </div>
            
            <div class="btn-group">
                <a href="form.html" class="btn btn-primary">Tambah Data</a>
                <a href="tampil_data.php" class="btn btn-secondary">Lihat Data</a>
            </div>
        </div>
    </body>
    </html>
    <?php
}

function displayError($errors) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error - Gagal Menyimpan Data</title>
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
                max-width: 500px;
                text-align: center;
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

            .error-icon {
                font-size: 60px;
                color: #dc3545;
                margin-bottom: 20px;
            }

            h1 {
                color: #dc3545;
                margin-bottom: 20px;
                font-size: 28px;
            }

            .error-list {
                background: #f8d7da;
                border: 1px solid #f5c6cb;
                border-radius: 10px;
                padding: 20px;
                margin: 20px 0;
                text-align: left;
            }

            .error-list ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .error-list li {
                color: #721c24;
                margin: 8px 0;
                padding-left: 20px;
                position: relative;
            }

            .error-list li::before {
                content: "⚠️";
                position: absolute;
                left: 0;
            }

            .btn {
                display: inline-block;
                padding: 12px 25px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                text-decoration: none;
                border-radius: 10px;
                font-weight: 600;
                margin-top: 20px;
                transition: all 0.3s ease;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="error-icon">❌</div>
            <h1>Gagal Menyimpan Data</h1>
            <p>Terjadi kesalahan saat menyimpan data mahasiswa:</p>
            
            <div class="error-list">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <a href="form.html" class="btn">Kembali</a>
        </div>
    </body>
    </html>
    <?php
}
?>