<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Detail Menu Makanan</title>
</head>
<body>
    <?php
    require 'config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM menu WHERE id=$id";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h1>Detail Menu Makanan</h1>";
            echo "<table>";
            echo "<tr><td><strong>Gambar:</strong></td><td><img src='images/" . $row['image'] . "' alt='" . $row['name'] . "' width='200'></td></tr>";
            echo "<tr><td><strong>Nama:</strong></td><td>" . $row['name'] . "</td></tr>";
            echo "<tr><td><strong>Jenis:</strong></td><td>" . $row['type'] . "</td></tr>";
            echo "<tr><td><strong>Harga:</strong></td><td>Rp " . number_format($row['price'], 0, ',', '.') . "</td></tr>";
            echo "<tr><td><strong>Deskripsi:</strong></td><td>" . $row['description'] . "</td></tr>";
            echo "</table>";
            echo "<a href='index.php'>Kembali ke Menu</a>";
        } else {
            echo "Menu tidak ditemukan.";
        }
    } else {
        echo "ID tidak ditemukan.";
    }
    ?>
</body>
</html>