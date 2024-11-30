<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan kembali ke login.php
    header("Location: login.php");
    exit;
}

// Query untuk menampilkan semua data menu dari database
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Restoran</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Menu Restoran</h2>
    <a href="add_menu.php">Tambah Menu</a>
    <a href="logout.php">Logout</a>
    <table>
        <tr>
            <th>Nama Makanan</th>
            <th>Jenis Makanan</th>
            <th>Harga</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <a href="edit_menu.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete_menu.php?id=<?php echo $row['id']; ?>">Delete</a> |
                    <a href="detail_menu.php?id=<?php echo $row['id']; ?>">Detail</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>