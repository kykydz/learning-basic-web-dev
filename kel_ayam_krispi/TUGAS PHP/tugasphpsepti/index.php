<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <h2>Daftar Mahasiswa</h2>
    <a href="tambah.php">+ Tambah Mahasiswa</a><br><br>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM mahasiswa");

        if (!$result) {
            echo "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['nim']}</td>
                        <td>{$row['jurusan']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}'>Edit</a> |
                            <a href='hapus.php?id={$row['id']}' onclick='return confirm(\"Yakin?\")'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Belum ada data</td></tr>";
        }
        ?>
    </table>
</body>
</html>
