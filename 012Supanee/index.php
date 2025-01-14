<?php
require_once 'db/connect.php';

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>รายการสินค้า</title>
    <!-- เชื่อมต่อ style.css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>รายการสินค้า</h1>
    <a href="add.php">เพิ่มสินค้า</a>
    <table border="1">
        <thead>
            <tr>
                <th>ชื่อสินค้า</th>
                <th>หมวดหมู่</th>
                <th>ราคา</th>
                <th>สต็อก</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>">แก้ไข</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('คุณต้องการลบสินค้านี้หรือไม่?')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
