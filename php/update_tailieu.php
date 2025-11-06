<?php
include 'connect.php';
header('Content-Type: application/json');

$id = $_POST['id'] ?? '';
$ten = $_POST['tentailieu'] ?? '';
$phi = $_POST['phi'] ?? '';
$danhmucid = $_POST['danhmucid'] ?? '';

if (empty($id) || empty($ten)) {
    echo json_encode(['success' => false, 'message' => 'Thiếu dữ liệu cần cập nhật.']);
    exit;
}

$file_sql = "";
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

// ✅ Xử lý file tài liệu (fileupload)
if (!empty($_FILES['file']['name'])) {
    $fileName = time() . '_' . basename($_FILES['file']['name']);
    $targetPath = $uploadDir . $fileName;
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
    $file_sql .= ", fileupload = '$fileName'";
}

// ✅ Xử lý ảnh trang bìa (trangbia)
if (!empty($_FILES['trangbia']['name'])) {
    $thumbName = time() . '_' . basename($_FILES['trangbia']['name']);
    $thumbPath = $uploadDir . $thumbName;
    move_uploaded_file($_FILES['trangbia']['tmp_name'], $thumbPath);
    $file_sql .= ", trangbia = '$thumbName'";
}

// ✅ Cập nhật dữ liệu
$sql = "UPDATE tailieu 
        SET tentailieu = ?, phi = ?, danhmucid = ? $file_sql 
        WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdii", $ten, $phi, $danhmucid, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cập nhật thành công!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi cập nhật: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
