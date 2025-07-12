<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "form"; // Nama database

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data dari form
$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];

// Simpan ke tabel "pendaftar"
$sql = "INSERT INTO form (nama, alamat) VALUES ('$nama', '$alamat')";
$query = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hasil</title>
</head>

<body>
    <?php if ($query): ?>
        <p>✅ Data berhasil disimpan!</p>
    <?php else: ?>
        <p>❌ Gagal menyimpan data: <?= mysqli_error($koneksi); ?></p>
    <?php endif; ?>

    <!-- Tombol kembali -->
    <br>
    <a href="form.php">
        <button>Kembali ke Form</button>
    </a>
</body>

</html>