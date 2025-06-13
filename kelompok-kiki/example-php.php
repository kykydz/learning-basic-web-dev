<?php
// Database connection settings
$host = 'localhost';
$db = 'local_kp';
$user = 'root';
$pass = ''; // Replace with your MySQL password if set

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$sql = "SELECT id, name, email FROM client";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Users Table</h2>

<table>
    <tr>
        <th>ID</th><th>Name</th><th>Email</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="3">No data found</td></tr>
    <?php endif; ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
