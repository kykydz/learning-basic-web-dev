<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Data Mahasiswa</h2>
    <a href="add.php" class="btn btn-primary mb-3">Tambah Data</a>
    <table class="table table-bordered">
        <tr>
            <th>NIM</th><th>Nama</th><th>Jurusan</th><th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM mahasiswa");
        while ($data = mysqli_fetch_assoc($query)) {
            echo "<tr>
                    <td>{$data['nim']}</td>
                    <td>{$data['nama']}</td>
                    <td>{$data['jurusan']}</td>
                    <td>
                        <a href='edit.php?nim={$data['nim']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete.php?nim={$data['nim']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin?')\">Hapus</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>
