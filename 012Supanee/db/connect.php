<?php
$host = '127.0.0.1';
$user = 'root';
$pass = ''; // รหัสผ่าน MySQL (ถ้าไม่มีให้เว้นว่าง)
$dbname = 'shop';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>