<?php
include 'connect.php';
header('Content-Type: application/json; charset=utf-8');

// Câu truy vấn chính xác — lưu ý tên cột phải trùng với trong database
$sql = "SELECT id, tendanhmuc, created_at, icon FROM danhmuc";
$result = $conn->query($sql);

$danhmucs = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $danhmucs[] = [
            'id' => $row['id'],
            'tendanhmuc' => $row['tendanhmuc'],
            'icon' => $row['icon'],
            'created_at' => $row['created_at']
        ];
    }
}

echo json_encode($danhmucs, JSON_UNESCAPED_UNICODE);
?>
