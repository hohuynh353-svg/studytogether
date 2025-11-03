<?php
include 'connect.php';
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Thiếu ID tài liệu.']);
    exit;
}

$id = intval($_GET['id']);
$sql = "DELETE FROM tailieu WHERE id = $id";

if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Xóa tài liệu thành công!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi xóa: ' . $conn->error]);
}
?>
