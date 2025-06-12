<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa"; // Ganti dengan nama database kamu

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel
$sql = "SELECT * FROM mahasiswa"; // Ganti dengan nama tabel kamu
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="form.html">+ Tambah Data Baru</a><br><br>
    <table border="1" cellpadding="8">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Tampilkan data per baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nim"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["jurusan"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Belum ada data.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
