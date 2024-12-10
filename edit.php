<?php
require_once 'db/connect.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    $sql = "UPDATE products SET name='$name', category='$category', price='$price', stock='$stock', description='$description' WHERE id = $id";
    if ($conn->query($sql)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขสินค้า</title>
    <!-- เชื่อมต่อ style.css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>แก้ไขสินค้า</h1>
    <form method="post">
        ชื่อสินค้า: <input type="text" name="name" value="<?= $product['name'] ?>" required><br>
        หมวดหมู่: <input type="text" name="category" value="<?= $product['category'] ?>" required><br>
        ราคา: <input type="number" name="price" value="<?= $product['price'] ?>" required><br>
        สต็อก: <input type="number" name="stock" value="<?= $product['stock'] ?>" required><br>
        รายละเอียด: <textarea name="description" required><?= $product['description'] ?></textarea><br>
        <button type="submit">บันทึก</button>
    </form>
</body>
</html>
