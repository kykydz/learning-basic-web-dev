<?php include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $conn->query("INSERT INTO mahasiswa (nama, nim, jurusan) VALUES ('$nama', '$nim', '$jurusan')");
    header("Location: index.php");
}
?>
<h2>Tambah Mahasiswa</h2>
<form method="POST">
    Nama: <input type="text" name="nama"><br>
    NIM: <input type="text" name="nim"><br>
    Jurusan: <input type="text" name="jurusan"><br>
    <button type="submit">Simpan</button>
</form>
<a href="index.php">Kembali</a>
