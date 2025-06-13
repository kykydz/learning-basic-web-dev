<?php
// Koneksi ke PostgreSQL
$conn = pg_connect("host=localhost dbname=tes1 user=kemal_354 password=kemal");

if (!$conn) {
    die("Koneksi gagal: " . pg_last_error());
}

// Ambil data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$full_name = $_POST['full_name'];

// Insert ke tabel users
$query = "INSERT INTO users (username, email, full_name) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, array($username, $email, $full_name));

if ($result) {
    echo "<p style='color:green;'>Data berhasil disimpan!</p>";
    echo "<p><a href='input_user.html'>Kembali</a> | <a href='daftar_users.php'>Lihat Daftar Users</a></p>";
} else {
    echo "<p style='color:red;'>Gagal menyimpan data: " . pg_last_error($conn) . "</p>";
}

pg_close($conn);
?>
