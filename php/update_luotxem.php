<?php
include 'connect.php';

$id = $_POST['id'] ?? 0;
if ($id) {
    $sql = "UPDATE tailieu SET luotxem = luotxem + 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
