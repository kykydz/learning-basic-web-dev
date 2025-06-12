<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa";

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];

// Query untuk insert data
$sql = "INSERT INTO mahasiswa (nama, jurusan) VALUES ('$nama', '$jurusan')";

if ($conn->query($sql) === TRUE) {
    // Ambil ID data terakhir yang dimasukkan
    $last_id = $conn->insert_id;

    // Ambil kembali data yang barusan dimasukkan
    $result = $conn->query("SELECT * FROM mahasiswa WHERE nim = $last_id");

    echo "<h2>Data berhasil disimpan!</h2>";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>NIM</th><th>Nama</th><th>Jurusan</th></tr>";
        echo "<tr>";
        echo "<td>" . $row['nim'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['jurusan'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "Gagal menampilkan data yang baru disimpan.";
    }

    echo "<br><a href='form_input.html'>+ Tambah Data Lagi</a>";
    echo " | <a href='tampil_data.php'>Lihat Semua Data</a>";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
