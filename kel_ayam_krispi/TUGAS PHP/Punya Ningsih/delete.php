<?php include 'config.php'; ?>
<?php
$nim = $_GET['nim'];
mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim='$nim'");
header("Location: index.php");
?>
