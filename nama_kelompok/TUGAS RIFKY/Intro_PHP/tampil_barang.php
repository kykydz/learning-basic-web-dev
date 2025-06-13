<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "figure";

$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data dari tabel barang
$sql = "SELECT * FROM barang";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>
    <h2>Daftar Barang</h2>
    <a href="form_barang.html">Tambah Barang</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['ID']."</td>";
                echo "<td>".$row['Nama']."</td>";
                echo "<td>".$row['Harga']."</td>";
                echo "<td>".$row['Jumlah']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data barang</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Tutup koneksi
mysqli_close($conn);
?>
