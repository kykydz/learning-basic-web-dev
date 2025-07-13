<?php
include 'koneksi.php';
$id = $_GET['id'];

$sql = "SELECT * FROM adoption WHERE id_adop = $id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Adopsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Edit Data Adopsi</h2>
        <form action="update_adoption.php" method="POST" class="space-y-4">
            <input type="hidden" name="id_adop" value="<?= $data['id_adop'] ?>">

            <div>
                <label class="block text-gray-700 font-medium">Nama Adopter:</label>
                <input type="text" name="nama_adopter" value="<?= $data['nama_adopter'] ?>" required
                    class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Jenis Hewan:</label>
                <input type="text" name="jenis_hewan" value="<?= $data['jenis_hewan'] ?>" required
                    class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Tanggal Adopsi:</label>
                <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required
                    class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Catatan:</label>
                <textarea name="notes" rows="3" class="w-full mt-1 px-3 py-2 border rounded"><?= $data['notes'] ?></textarea>
            </div>

            <div class="text-center">
                <input type="submit" value="Simpan Perubahan"
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
            </div>
        </form>
    </div>
</body>
</html>
