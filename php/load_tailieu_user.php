<?php
session_start();
include 'connect.php';
header('Content-Type: application/json');

// 🔒 Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập']);
    exit;
}

$userID = $_SESSION['user_id'];
$baseURL = 'http://localhost/doan4/php/uploads/';

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
    WHERE t.nguoiupload = ?
    ORDER BY t.id DESC
";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $row['ngayupload'] = date('Y-m-d H:i:s', strtotime($row['ngayupload']));

    // ✅ Xử lý fileupload
    if (!empty($row['fileupload'])) {
        $file = trim($row['fileupload']);

        // Nếu đã chứa "http", giữ nguyên
        if (strpos($file, 'http://') === 0 || strpos($file, 'https://') === 0) {
            $row['fileupload'] = $file;
        } else {
            // Nếu bắt đầu bằng "uploads/", bỏ nó đi để tránh lặp
            $file = preg_replace('#^uploads/#', '', $file);
            $row['fileupload'] = $baseURL . $file;
        }
    }

    // ✅ Xử lý trangbia
    if (!empty($row['trangbia'])) {
        $bia = trim($row['trangbia']);
        if (strpos($bia, 'http://') === 0 || strpos($bia, 'https://') === 0) {
            $row['trangbia'] = $bia;
        } else {
            $bia = preg_replace('#^uploads/#', '', $bia);
            $row['trangbia'] = $baseURL . $bia;
        }
    } else {
        $row['trangbia'] = null;
    }

    $data[] = $row;
}

echo json_encode(['success' => true, 'data' => $data]);

$stmt->close();
$conn->close();
?>
