<?php
require_once 'db.php';

$id = $_GET['id'];

// ดึงข้อมูลสินค้าเดิม
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE products SET name = '$name', price = '$price', quantity = '$quantity' WHERE id = $id";
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
    <title>แก้ไขสินค้า</title>
</head>
<body>
    <h1>แก้ไขสินค้า</h1>
    <form method="POST">
        ชื่อสินค้า: <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
        ราคา: <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required><br>
        จำนวน: <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>
        <button type="submit">บันทึก</button>
    </form>
</body>
</html>
