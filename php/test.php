<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thư viện tài liệu</title>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", sans-serif;
      background-color: #fff8dc; /* vàng nhạt */
      color: #222;
    }

    /* ✅ Chia bố cục 3 cột ngang: 20% - 60% - 20% */
    .container {
      display: grid;
      grid-template-columns: 20% 60% 20%;
      height: 100vh;
      gap: 10px;
      padding: 10px;
    }

    /* 🔸 Cột trái: bài viết admin */
    .left-panel {
      background-color: #fffaf0;
      border-right: 3px solid #000;
      padding: 15px;
      overflow-y: auto;
    }
    .left-panel h2 {
      font-size: 20px;
      color: #000;
      border-bottom: 2px solid #000;
      padding-bottom: 5px;
      margin-bottom: 10px;
    }
    .admin-post {
      background-color: #000;
      color: #fff;
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 10px;
      transition: 0.3s;
    }
    .admin-post:hover {
      background-color: #222;
      transform: translateY(-3px);
    }

    /* 🔸 Cột giữa: card tài liệu */
    .center-panel {
      background-color: #fff;
      border-radius: 10px;
      padding: 20px;
      overflow-y: auto;
    }
    .center-panel h2 {
      color: #000;
      border-bottom: 2px solid #ffd700;
      margin-bottom: 20px;
    }
    .document-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }
    .doc-card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 15px;
      transition: 0.3s;
      text-align: center;
    }
    .doc-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }
    .doc-card img {
      width: 100%;
      height: 130px;
      object-fit: cover;
      border-radius: 10px;
    }
    .doc-card h3 {
      margin: 10px 0 5px;
      color: #000;
      font-size: 18px;
    }

    /* 🔸 Cột phải: tài liệu mới + người đóng góp */
    .right-panel {
      background-color: #fffaf0;
      border-left: 3px solid #000;
      padding: 15px;
      overflow-y: auto;
    }
    .right-section {
      margin-bottom: 20px;
    }
    .right-section h3 {
      color: #000;
      border-bottom: 2px solid #000;
      margin-bottom: 10px;
    }
    .right-section ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .right-section li {
      background-color: #000;
      color: #fff;
      border-radius: 6px;
      padding: 8px 10px;
      margin-bottom: 6px;
      transition: 0.3s;
    }
    .right-section li:hover {
      background-color: #333;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- 🔹 Cột trái: Bài viết admin -->
    <div class="left-panel">
      <h2>📰 Bài viết từ Admin</h2>
      <div class="admin-post">📢 Cập nhật giao diện mới</div>
      <div class="admin-post">💡 Mẹo sử dụng tài liệu hiệu quả</div>
      <div class="admin-post">🛠️ Hướng dẫn đăng tài liệu</div>
    </div>

    <!-- 🔹 Cột giữa: Các tài liệu -->
    <div class="center-panel">
      <h2>🔥 Tài liệu phổ biến</h2>
      <div class="document-grid">
        <div class="doc-card">
          <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" alt="">
          <h3>Lập trình PHP từ cơ bản đến nâng cao</h3>
          <p>👤 Nguyễn Văn A</p>
          <p>💰 Miễn phí</p>
        </div>
        <div class="doc-card">
          <img src="https://cdn-icons-png.flaticon.com/512/906/906175.png" alt="">
          <h3>Toán cao cấp - Đại học Bách Khoa</h3>
          <p>👤 Lê Thị B</p>
          <p>💰 15.000 VNĐ</p>
        </div>
        <div class="doc-card">
          <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="">
          <h3>IELTS Speaking – Chiến lược 8.0+</h3>
          <p>👤 Phạm Văn C</p>
          <p>💰 25.000 VNĐ</p>
        </div>
      </div>
    </div>

    <!-- 🔹 Cột phải: Tài liệu mới + Người đóng góp -->
    <div class="right-panel">
      <div class="right-section">
        <h3>📄 Tài liệu mới nhất</h3>
        <ul>
          <li>Python Machine Learning 2025</li>
          <li>TOEIC Listening Practice</li>
          <li>Marketing căn bản</li>
          <li>Data Structures & Algorithms</li>
        </ul>
      </div>

      <div class="right-section">
        <h3>🏅 Người đóng góp xuất sắc</h3>
        <ul>
          <li>Nguyễn Văn A</li>
          <li>Trần Thị B</li>
          <li>Phạm Văn C</li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
