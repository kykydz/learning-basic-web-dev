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

$limit = 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$search_condition = '';
$search_params = [];

if (!empty($search)) {
    $search_condition = "WHERE nama LIKE ? OR nim LIKE ? OR email LIKE ? OR jurusan LIKE ?";
    $search_term = "%$search%";
    $search_params = [$search_term, $search_term, $search_term, $search_term];
}

$count_sql = "SELECT COUNT(*) as total FROM mahasiswa $search_condition";
$count_stmt = $conn->prepare($count_sql);
if (!empty($search_params)) {
    $count_stmt->bind_param("ssss", ...$search_params);
}
$count_stmt->execute();
$total_data = $count_stmt->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit);

$sql = "SELECT * FROM mahasiswa $search_condition ORDER BY tanggal_daftar DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);

if (!empty($search_params)) {
    $search_params[] = $limit;
    $search_params[] = $offset;
    $stmt->bind_param("ssssii", ...$search_params);
} else {
    $stmt->bind_param("ii", $limit, $offset);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: center;
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 16px;
        }

        .controls {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-box {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 400px;
        }

        .search-input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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

        .data-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
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

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-weight: 600;
            color: #495057;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }

        .no-data-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 25px;
            background: white;
            margin-top: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .pagination a, .pagination span {
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination a {
            background: #f8f9fa;
            color: #495057;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-1px);
        }

        .pagination .current {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stats {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-item {
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box {
                max-width: none;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            th, td {
                padding: 10px 8px;
                font-size: 14px;
            }
            
            .pagination {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Data Mahasiswa</h1>
        </div>

        <?php
        $total_mahasiswa = $conn->query("SELECT COUNT(*) as total FROM mahasiswa")->fetch_assoc()['total'];
        $total_jurusan = $conn->query("SELECT COUNT(DISTINCT jurusan) as total FROM mahasiswa")->fetch_assoc()['total'];
        $mahasiswa_terbaru = $conn->query("SELECT COUNT(*) as total FROM mahasiswa WHERE DATE(tanggal_daftar) = CURDATE()")->fetch_assoc()['total'];
        ?>

        <div class="stats">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number"><?php echo $total_mahasiswa; ?></div>
                    <div class="stat-label">Total Mahasiswa</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $total_jurusan; ?></div>
                    <div class="stat-label">Total Jurusan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $mahasiswa_terbaru; ?></div>
                    <div class="stat-label">Pendaftar Hari Ini</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $total_data; ?></div>
                    <div class="stat-label">Data Ditemukan</div>
                </div>
            </div>
        </div>

        <div class="controls">
            <form method="GET" class="search-box">
                <input type="text" name="search" class="search-input" 
                       placeholder="🔍 Cari berdasarkan nama, NIM, email, atau jurusan..." 
                       value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if (!empty($search)): ?>
                    <a href="tampil_data.php" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </form>
            <a href="form.html" class="btn btn-success">Tambah</a>
        </div>

        <div class="data-container">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jurusan</th>
                                <th>Angkatan</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($row["nim"]); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row["nama"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["jurusan"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["angkatan"]); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($row["tanggal_daftar"])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-data">
                    <h3>Tidak Ada Data</h3>
                    <p>
                        <?php if (!empty($search)): ?>
                            Tidak ditemukan data mahasiswa yang sesuai dengan pencarian "<?php echo htmlspecialchars($search); ?>"
                        <?php else: ?>
                            Belum ada data mahasiswa yang terdaftar dalam sistem.
                        <?php endif; ?>
                    </p>
                    <br>
                    <a href="form.html" class="btn btn-success">Tambah</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=1<?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>">⏮️ Pertama</a>
                    <a href="?page=<?php echo $page-1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>">⬅️ Sebelumnya</a>
                <?php endif; ?>

                <?php
                $start_page = max(1, $page - 2);
                $end_page = min($total_pages, $page + 2);
                
                for ($i = $start_page; $i <= $end_page; $i++):
                ?>
                    <?php if ($i == $page): ?>
                        <span class="current"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page+1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>">Selanjutnya ➡️</a>
                    <a href="?page=<?php echo $total_pages; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>">Terakhir ⏭️</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        let searchTimeout;
        document.querySelector('.search-input').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    this.form.submit();
                }
            }, 500);
        });

        <?php if (!empty($search)): ?>
        document.addEventListener('DOMContentLoaded', function() {
            const searchTerm = <?php echo json_encode($search); ?>;
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            
            document.querySelectorAll('td').forEach(cell => {
                if (cell.textContent.toLowerCase().includes(searchTerm.toLowerCase())) {
                    cell.innerHTML = cell.innerHTML.replace(regex, '<mark style="background: #fff3cd; padding: 2px 4px; border-radius: 3px;">$1</mark>');
                }
            });
        });
        <?php endif; ?>
    </script>
</body>
</html>

<?php
$conn->close();
?>

