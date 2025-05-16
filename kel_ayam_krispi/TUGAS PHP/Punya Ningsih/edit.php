<?php include 'config.php'; ?>
<?php
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Data</title></head>
<body class="container mt-4">
    <h2>Tambah Mahasiswa</h2>
    <form method="POST">
        NIM: <input type="text" name="nim" required class="form-control mb-2">
        Nama: <input type="text" name="nama" required class="form-control mb-2">
        Jurusan: <input type="text" name="jurusan" required class="form-control mb-2">
        <button name="submit" class="btn btn-success">Simpan</button>
    </form>
</body>
</html>
