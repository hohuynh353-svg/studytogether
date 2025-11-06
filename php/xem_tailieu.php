<?php
include 'connect.php';
$id = $_GET['id'] ?? 0;

// Tăng lượt xem
if ($id) {
    $conn->query("UPDATE tailieu SET luotxem = luotxem + 1 WHERE id = $id");
}

// Sau đó load chi tiết tài liệu
$result = $conn->query("SELECT * FROM tailieu WHERE id = $id");
$tailieu = $result->fetch_assoc();
?>
