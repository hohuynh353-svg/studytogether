<?php
include 'connect.php';

$id = $_GET['id'] ?? 0;
if (!$id) {
    echo "<p>Không tìm thấy tài liệu.</p>";
    exit;
}

$sql = "SELECT t.*, d.tendanhmuc, u.hoten 
        FROM tailieu t
        LEFT JOIN danhmuc d ON t.danhmucid = d.id
        LEFT JOIN users u ON t.nguoiupload = u.id
        WHERE t.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo '
    <div class="doc-detail">
        <h2>' . htmlspecialchars($row['tentailieu']) . '</h2>
        <p><strong>Danh mục:</strong> ' . htmlspecialchars($row['tendanhmuc']) . '</p>
        <p><strong>Người upload:</strong> ' . htmlspecialchars($row['hoten']) . '</p>
        <p><strong>Mô tả:</strong> ' . htmlspecialchars($row['mota'] ?? 'Chưa có mô tả.') . '</p>
        <p><strong>Lượt xem:</strong> ' . ($row['luotxem'] ?? 0) . '</p>
        <p><strong>Lượt tải xuống:</strong> ' . ($row['luottaixuong'] ?? 0) . '</p>
        <a href="download.php?id=' . $row['id'] . '" class="download-btn">📥 Tải xuống</a>

    </div>';
} else {
    echo "<p>Không tìm thấy tài liệu.</p>";
}
?>
