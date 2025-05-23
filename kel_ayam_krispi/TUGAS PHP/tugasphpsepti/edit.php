<?php include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM mahasiswa WHERE id=$id");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $conn->query("UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan' WHERE id=$id");
    header("Location: index.php");
}
?>
<h2>Edit Mahasiswa</h2>
<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>"><br>
    NIM: <input type="text" name="nim" value="<?= $data['nim'] ?>"><br>
    Jurusan: <input type="text" name="jurusan" value="<?= $data['jurusan'] ?>"><br>
    <button type="submit">Update</button>
</form>
<a href="index.php">Kembali</a>
