<?php
include 'connect.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = $_POST['id'] ?? 0;
    $tenTaiLieu = $_POST['ten_tai_lieu'] ?? '';
    $danhMuc   = $_POST['danh_muc'] ?? '';
    $phi       = $_POST['phi'] ?? 0;

    if (!$id || !$tenTaiLieu || !$danhMuc) {
        echo json_encode(['success' => false, 'message' => 'Thiếu dữ liệu cần thiết.']);
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    // Nếu có upload file mới
    $fileUpload = "";
    if (!empty($_FILES['file']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileName = time() . '_' . basename($_FILES['file']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            $fileUpload = ", fileupload = '$fileName'";
        }
    }

    if ($role === 'admin') {
        $sql = "UPDATE tailieu SET tentailieu=?, danhmucid=?, phi=? $fileUpload WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sidi", $tenTaiLieu, $danhMuc, $phi, $id);
    } else {
        $sql = "UPDATE tailieu SET tentailieu=?, danhmucid=?, phi=? $fileUpload WHERE id=? AND nguoiupload=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sidii", $tenTaiLieu, $danhMuc, $phi, $id, $user_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cập nhật thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể cập nhật.']);
    }

    $stmt->close();
}
?>
