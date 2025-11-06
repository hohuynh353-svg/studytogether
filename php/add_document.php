<?php
header('Content-Type: application/json');
include 'connect.php';
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để thêm tài liệu.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $tenTaiLieu = $_POST['ten_tai_lieu'] ?? '';
    $danhMuc    = $_POST['danh_muc'] ?? '';
    $phi        = $_POST['phi'] ?? 0;
    $filePDF    = $_FILES['file'] ?? null;
    $trangBia   = $_FILES['trangbia'] ?? null;
    $user_id    = $_SESSION['user_id']; // ID người upload (liên kết bảng users)

    // Kiểm tra dữ liệu
    if (empty($tenTaiLieu) || empty($danhMuc) || !$filePDF || !$trangBia) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đủ thông tin và chọn đầy đủ file.']);
        exit;
    }

    // Thư mục lưu file
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Tạo tên file duy nhất cho PDF
    $fileNamePDF = time() . '_' . basename($filePDF['name']);
    $targetPDF = $uploadDir . $fileNamePDF;

    // Tạo tên file duy nhất cho ảnh bìa
    $fileNameBia = time() . '_bia_' . basename($trangBia['name']);
    $targetBia = $uploadDir . $fileNameBia;

    // Tiến hành upload cả 2 file
    if (move_uploaded_file($filePDF['tmp_name'], $targetPDF) && move_uploaded_file($trangBia['tmp_name'], $targetBia)) {

        // ✅ Lưu vào CSDL
        $stmt = $conn->prepare("
            INSERT INTO tailieu (tentailieu, danhmucid, nguoiupload, fileupload, trangbia, phi, ngayupload, trangthai)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), 'choduyet')
        ");

        // Thứ tự: tên tài liệu, id danh mục, id người upload, tên file PDF, tên ảnh bìa, phí
        $stmt->bind_param("siissd", $tenTaiLieu, $danhMuc, $user_id, $fileNamePDF, $fileNameBia, $phi);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Thêm tài liệu thành công!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi SQL: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể upload file hoặc ảnh bìa.']);
    }
}
?>
