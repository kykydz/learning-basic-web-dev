<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = ""; // kosong jika default Laragon
$database = "cat adoption";

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel adoption
$sql = "SELECT * FROM adoption";
$result = $conn->query($sql);

// Tampilkan data dalam bentuk tabel HTML
echo "<h2>Daftar Data Adopsi Hewan</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr>
        <th>ID</th>
        <th>Nama Adopter</th>
        <th>Jenis Hewan</th>
        <th>Tanggal</th>
        <th>Notes</th>
      </tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_adop"] . "</td>";
        echo "<td>" . $row["nama_adopter"] . "</td>";
        echo "<td>" . $row["jenis_hewan"] . "</td>";
        echo "<td>" . $row["tanggal"] . "</td>";
        echo "<td>" . $row["notes"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Tidak ada data adopsi.</td></tr>";
}
echo "</table>";

// Tambahkan tombol kembali
echo "<br><a href='index.html' style='
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-family: sans-serif;
'>Kembali ke Menu</a>";

$conn->close();
?>
