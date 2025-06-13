<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Users</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; max-width: 600px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

<h2>Daftar Users</h2>

<?php

// Koneksi ke PostgreSQL
$conn = pg_connect("host=localhost dbname=tes1 user=kemal_354 password=kemal");

if (!$conn) {
    echo "failed here to connect";
    die("<p style='color:red;'>Koneksi gagal: " . pg_last_error() . "</p>");
} else {
    // Set schema ke 'public'
    pg_query($conn, "SET search_path TO public");

    $dbname = pg_dbname($conn);
    echo "<p>Connected to database: $dbname</p>";

    $result = pg_query($conn, "
    SELECT table_schema, table_name
    FROM information_schema.tables
    WHERE table_type = 'BASE TABLE'
    AND table_schema NOT IN ('pg_catalog', 'information_schema');
    ");

    echo "<h3>Tables in DB</h3><ul>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<li>{$row['table_schema']}.{$row['table_name']}</li>";
    }
    echo "</ul>";
}

// Ambil data dari tabel users
$result = pg_query($conn, "SELECT id, username, email, full_name FROM users");

if (!$result) {
    die("<p style='color:red;'>Query gagal: " . pg_last_error() . "</p>");
}

echo "<table>";
echo "<tr><th>Username</th><th>Email</th><th>Nama Lengkap</th></tr>";

while ($row = pg_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['username']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['full_name']}</td>";
    echo "</tr>";
}

echo "</table>";

// Tutup koneksi
pg_close($conn);
?>

</body>
</html>
