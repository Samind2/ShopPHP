<?php
require_once 'db/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    $sql = "INSERT INTO products (name, category, price, stock, description) VALUES ('$name', '$category', '$price', '$stock', '$description')";
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
    <title>เพิ่มสินค้า</title>
    <!-- เชื่อมต่อ style.css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>เพิ่มสินค้า</h1>
    <form method="post">
        ชื่อสินค้า: <input type="text" name="name" required><br>
        หมวดหมู่: <input type="text" name="category" required><br>
        ราคา: <input type="number" name="price" required><br>
        สต็อก: <input type="number" name="stock" required><br>
        รายละเอียด: <textarea name="description" required></textarea><br>
        <button type="submit">บันทึก</button>
    </form>
</body>
</html>
