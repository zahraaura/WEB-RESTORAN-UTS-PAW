<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    // Upload gambar ke folder images
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO menu (name, type, price, description, image) VALUES ('$name', '$type', '$price', '$description', '$image')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Gambar gagal diupload.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Tambah Menu Makanan</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Makanan</label>
        <input type="text" name="name" required><br>

        <label>Jenis Makanan</label>
        <select name="type" required>
            <option value="Makanan Utama">Makanan Utama</option>
            <option value="Dessert">Dessert</option>
        </select><br>

        <label>Harga</label>
        <input type="number" name="price" required><br>

        <label>Deskripsi</label>
        <textarea name="description" required></textarea><br>

        <label>Upload Gambar</label>
        <input type="file" name="image" accept="image/*" required><br>

        <button type="submit">Tambah Menu</button>
    </form>
</body>
</html>