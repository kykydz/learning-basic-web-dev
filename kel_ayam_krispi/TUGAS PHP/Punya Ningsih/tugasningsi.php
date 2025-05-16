CREATE DATABASE db_mahasiswa;
USE db_mahasiswa;

CREATE TABLE mahasiswa (
    nim VARCHAR(10) PRIMARY KEY,
    nama VARCHAR(50),
    jurusan VARCHAR(50)
);

<?php
// Koneksi database
$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Tambah data
if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')");
    header("Location: index.php");
}

// Update data
if (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    mysqli_query($conn, "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan' WHERE nim='$nim'");
    header("Location: index.php");
}

// Hapus data
if (isset($_GET['hapus'])) {
    $nim = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim='$nim'");
    header("Location: index.php");
}

// Ambil data edit
$edit = null;
if (isset($_GET['edit'])) {
    $nim_edit = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim_edit'"));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa AKPRIND</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <!-- Logo dan Judul -->
    <div class="text-center mb-4">
        <img src="https://upload.wikimedia.org/wikipedia/id/thumb/0/06/Logo_AKPRIND.png/200px-Logo_AKPRIND.png" alt="Logo AKPRIND" height="100">
        <h3 class="mt-2">Universitas AKPRIND Yogyakarta</h3>
        <h4>CRUD Data Mahasiswa</h4>
    </div>

    <!-- Form Tambah / Edit -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST">
                <div class="mb-2">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" value="<?= $edit['nim'] ?? '' ?>" <?= isset($edit) ? 'readonly' : '' ?> required>
                </div>
                <div class="mb-2">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $edit['nama'] ?? '' ?>" required>
                </div>
                <div class="mb-2">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" value="<?= $edit['jurusan'] ?? '' ?>" required>
                </div>
                <button type="submit" name="<?= isset($edit) ? 'update' : 'tambah' ?>" class="btn btn-success">
                    <?= isset($edit) ? 'Update' : 'Tambah' ?>
                </button>
                <?php if (isset($edit)) : ?>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>NIM</th><th>Nama</th><th>Jurusan</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nim");
            while ($row = mysqli_fetch_assoc($data)) :
            ?>
                <tr>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['jurusan']; ?></td>
                    <td>
                        <a href="index.php?edit=<?= $row['nim']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?hapus=<?= $row['nim']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
