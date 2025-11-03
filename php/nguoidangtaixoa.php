<?php
include 'connect.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'Thiếu ID tài liệu.']);
        exit;
    }

    // Kiểm tra quyền xóa
    $role = $_SESSION['role'];
    $user_id = $_SESSION['user_id'];

    if ($role === 'admin') {
        $sql = "DELETE FROM tailieu WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
    } else {
        // Chỉ được xóa tài liệu của chính mình
        $sql = "DELETE FROM tailieu WHERE id = ? AND nguoiupload = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $id, $user_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Xóa thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể xóa tài liệu.']);
    }

    $stmt->close();
}
?>
