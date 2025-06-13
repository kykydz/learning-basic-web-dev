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

// Ambil data dari form
$nama   = $_POST['nama'];
$harga  = $_POST['harga'];
$jumlah = $_POST['jumlah'];

// Query simpan ke tabel barang
$sql = "INSERT INTO barang (Nama, Harga, Jumlah) VALUES ('$nama', '$harga', '$jumlah')";

if (mysqli_query($conn, $sql)) {
    echo "Data berhasil disimpan. <a href='form_barang.html'>Input lagi</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>
