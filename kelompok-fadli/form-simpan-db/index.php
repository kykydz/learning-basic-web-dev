<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_form";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses simpan data
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = mysqli_real_escape_string($conn, $_POST["nama"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pesan = mysqli_real_escape_string($conn, $_POST["pesan"]);

    if ($nama && $email && $pesan) {
        $query = "INSERT INTO kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
        if (mysqli_query($conn, $query)) {
            $success = "Data berhasil disimpan!";
        } else {
            $success = "Gagal menyimpan data: " . mysqli_error($conn);
        }
    } else {
        $success = "Harap isi semua field.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Kontak - Simpan ke DB</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <main class="container">
    <section class="form-box">
      <h1>Form Kontak</h1>

      <?php if ($success): ?>
        <div class="alert"><?= $success ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <input type="text" name="nama" placeholder="Nama Lengkap" required />
        <input type="email" name="email" placeholder="Alamat Email" required />
        <textarea name="pesan" placeholder="Tulis pesan Anda..." rows="5" required></textarea>
        <button type="submit">Kirim</button>
      </form>
    </section>
  </main>
</body>
</html>
