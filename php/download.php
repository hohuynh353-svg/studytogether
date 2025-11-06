<?php
include 'connect.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $sql = "SELECT fileupload FROM tailieu WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        $filename = basename($row['fileupload']); 
        $filePath = __DIR__ . '/../php/uploads/' . $filename; // Lùi 1 cấp để ra ngoài thư mục php

        echo "🔍 Đang tìm file tại: $filePath<br>";

        if (file_exists($filePath)) {
            $conn->query("UPDATE tailieu SET luottai = luottai + 1 WHERE id = $id");

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filePath));
            flush();
            readfile($filePath);
            exit;
        } else {
            echo "❌ File không tồn tại tại đường dẫn: $filePath";
        }
    } else {
        echo "❌ Không tìm thấy fileupload trong CSDL cho id = $id";
    }
} else {
    echo "❌ Thiếu ID file cần tải!";
}
?>
