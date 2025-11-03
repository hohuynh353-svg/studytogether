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
    //  Lấy dữ liệu từ form
    $tenTaiLieu = $_POST['ten_tai_lieu'] ?? '';
    $danhMuc    = $_POST['danh_muc'] ?? '';
    $phi        = $_POST['phi'] ?? 0;
    $file       = $_FILES['file'] ?? null;
    $user_id    = $_SESSION['user_id']; // ID người upload (liên kết bảng users)

    // Kiểm tra dữ liệu
    if (empty($tenTaiLieu) || empty($danhMuc) || !$file) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đủ thông tin.']);
        exit;
    }

    // Thư mục lưu file
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Tạo tên file duy nhất
    $fileName = time() . '_' . basename($file['name']);
    $targetPath = $uploadDir . $fileName;

    //  Tiến hành upload file
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {

        // ✅ Lưu vào CSDL
        $stmt = $conn->prepare("
            INSERT INTO tailieu (tentailieu, danhmucid, nguoiupload, fileupload, phi, ngayupload)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");

        // Thứ tự: tên tài liệu, id danh mục, id người upload, tên file, phí
        $stmt->bind_param("siisd", $tenTaiLieu, $danhMuc, $user_id, $fileName, $phi);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Thêm tài liệu thành công!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi SQL: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Không thể upload file.']);
    }
}
?>
