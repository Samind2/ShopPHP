<?php
require_once 'db/connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id = $id";
if ($conn->query($sql)) {
    header('Location: index.php');
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
