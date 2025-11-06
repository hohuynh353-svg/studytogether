<?php
session_start();
include 'connect.php';
header('Content-Type: application/json');

// Kiểm tra quyền admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Không có quyền truy cập']);
    exit;
}

$sql = "
    SELECT 
        t.id, 
        t.tentailieu, 
        t.fileupload, 
        t.trangbia, 
        t.phi, 
        t.ngayupload, 
        t.trangthai,
        d.tendanhmuc AS ten_danh_muc,
        u.hoten AS ten_nguoi_upload
    FROM tailieu t
    LEFT JOIN danhmuc d ON t.danhmucid = d.id
    LEFT JOIN users u ON t.nguoiupload = u.id
    ORDER BY t.id DESC
";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $row['ngayupload'] = date('Y-m-d H:i:s', strtotime($row['ngayupload']));
    // KHÔNG nối thêm baseURL nữa
    $data[] = $row;
}

echo json_encode(['success' => true, 'data' => $data]);
?>
