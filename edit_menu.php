<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM menu WHERE id=$id";//Query untuk menampilkan data yang akan diubah berdasarkan id dan kemudian mengupdate data tersebut
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Jika ada gambar baru yang diupload
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE menu SET name='$name', type='$type', price='$price', description='$description', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE menu SET name='$name', type='$type', price='$price', description='$description' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Menu Makanan</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Makanan</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>

        <label>Jenis Makanan</label>
        <select name="type" required>
            <option value="Makanan Utama" <?php echo $row['type'] == 'Makanan Utama' ? 'selected' : ''; ?>>Makanan Utama</option>
            <option value="Dessert" <?php echo $row['type'] == 'Dessert' ? 'selected' : ''; ?>>Dessert</option>
        </select><br>

        <label>Harga</label>
        <input type="number" name="price" value="<?php echo $row['price']; ?>" required><br>

        <label>Deskripsi</label>
        <textarea name="description" required><?php echo $row['description']; ?></textarea><br>

        <label>Upload Gambar Baru (kosongkan jika tidak ingin mengganti)</label>
        <input type="file" name="image" accept="image/*"><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>