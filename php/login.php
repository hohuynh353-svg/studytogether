<?php
session_start();

// Kết nối database
$server = "localhost";
$user = "root";
$pass = "";
$db = "doan4";

$conn = new mysqli($server, $user, $pass, $db);
$conn->set_charset("utf8");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Lấy thêm cột 'role' để biết quyền của người dùng
    $stmt = $conn->prepare("SELECT id, hoten, email, matkhau, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['matkhau'])) {
            // Lưu thông tin đăng nhập vào session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['hoten'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Chuyển hướng dựa theo quyền
            if ($user['role'] == 'admin') {
                echo "<script>alert('Đăng nhập thành công với quyền Admin!'); window.location='admin.php';</script>";
            } elseif ($user['role'] == 'nguoitinhphi') {
                echo "<script>alert('Đăng nhập thành công với quyền Người tính phí!'); window.location='nguoidangtai.html';</script>";
            } else {
                echo "<script>alert('Đăng nhập thành công với quyền Khách hàng!'); window.location='index.php';</script>";
            }
        } else {
            echo "<script>alert('Sai mật khẩu!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Email không tồn tại!'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
