<?php
// Koneksi ke database
$host = 'localhost';
$db = 'local_kp';
$user = 'root';
$pass = ''; // Kosongkan jika tidak ada password MySQL

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel client
$sql = "SELECT id, name, email FROM client";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Client</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 1px 1px 2px #444;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 20px;
            overflow-x: auto;
        }

        table {
            border-collapse: collapse;
            width: 600px;
            color: #fff;
        }

        th, td {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-align: left;
        }

        th {
            background-color: rgba(255, 255, 255, 0.15);
            font-weight: bold;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 700px) {
            table {
                width: 90vw;
            }
        }
    </style>
</head>
<body>

<h2>👥 Daftar Client</h2>

<div class="table-container">
    <table>
        <tr>
            <th>ID</th><th>Nama</th><th>Email</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="3" style="text-align:center;">Tidak ada data ditemukan</td></tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
