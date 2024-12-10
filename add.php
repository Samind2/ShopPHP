<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO products (name, price, quantity) VALUES ('$name', '$price', '$quantity')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสินค้า</title>
</head>
<body>
    <h1>เพิ่มสินค้า</h1>
    <form method="POST">
        ชื่อสินค้า: <input type="text" name="name" required><br>
        ราคา: <input type="number" name="price" step="0.01" required><br>
        จำนวน: <input type="number" name="quantity" required><br>
        <button type="submit">เพิ่ม</button>
    </form>
</body>
</html>
