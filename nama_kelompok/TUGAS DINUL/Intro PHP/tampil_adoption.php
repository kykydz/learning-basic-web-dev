<?php
include 'koneksi.php'; // Hubungkan ke file koneksi

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
        <th>Aksi</th> <!-- Tambahan kolom aksi -->
      </tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_adop"] . "</td>";
        echo "<td>" . $row["nama_adopter"] . "</td>";
        echo "<td>" . $row["jenis_hewan"] . "</td>";
        echo "<td>" . $row["tanggal"] . "</td>";
        echo "<td>" . $row["notes"] . "</td>";
        echo "<td>
        <a href='edit_adoption.php?id=" . $row["id_adop"] . "' class='mr-2'>✏ Edit</a>
        <a href='hapus_adoption.php?id=" . $row["id_adop"] . "' 
           onclick=\"return confirm('Yakin ingin menghapus data ini?')\">🗑 Hapus</a>
        </td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Tidak ada data adopsi.</td></tr>";
}
echo "</table>";

// Tombol kembali
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
