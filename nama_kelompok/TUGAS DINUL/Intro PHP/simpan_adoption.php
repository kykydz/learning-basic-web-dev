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

// Ambil data dari form
$nama_adopter = $_POST['nama_adopter'];
$jenis_hewan  = $_POST['jenis_hewan'];
$tanggal      = $_POST['tanggal'];
$notes        = $_POST['notes'];

// Simpan ke database
$sql = "INSERT INTO adoption (nama_adopter, jenis_hewan, tanggal, notes)
        VALUES ('$nama_adopter', '$jenis_hewan', '$tanggal', '$notes')";

if ($conn->query($sql) === TRUE) {
    echo "Data adopsi berhasil disimpan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

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
