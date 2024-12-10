<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if (!$result) {
    die("Error in query: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าทั้งหมด</title>
</head>
<body>
    <h1>รายการสินค้า</h1>
    <a href="add.php">เพิ่มสินค้า</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ชื่อสินค้า</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>จัดการ</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">แก้ไข</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('ยืนยันการลบสินค้านี้?');">ลบ</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">ไม่มีสินค้าที่จะแสดง</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
