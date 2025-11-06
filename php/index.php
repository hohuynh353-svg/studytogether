<?php
session_start();

// Giả lập dữ liệu người dùng đã đăng nhập
$isLoggedIn = true;
$user = [
    'name' => 'Nguyễn Văn A',
    'avatar' => '👤'
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyTogether - Nền tảng chia sẻ tài liệu học tập</title>
    <link rel="stylesheet" href="../css/index.css">

    <style>
        /* 🟡 CSS đơn giản cho phần bố cục 3 cột */
        .main-layout {
            display: grid;
            grid-template-columns: 20% 60% 20%;
            gap: 10px;
            padding: 15px;
        }
        .column {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            min-height: 400px;
        }
        .column h2 {
            font-size: 18px;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }

      
         /* --- GRID CHỨA CÁC CARD --- */
        .cards-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
         gap: 70px;
        padding: 20px;
        }

         /* --- CARD CHÍNH --- */
          .doc-card {
         background: #fff;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  transition: all 0.25s ease;
  display: flex;
  flex-direction: column;
 }

  .doc-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
  }

   /* --- ẢNH TRÊN CÙNG --- */
  .doc-thumb {
  background: linear-gradient(135deg, #7b6ef6, #5ac8fa);
  height: 160px;
  display: flex;
  align-items: center;
  justify-content: center;
  }

  .doc-thumb img {
  width: 90px;
  height: 90px;
  object-fit: contain;
  border-radius: 10px;
  }

  /* --- THÂN CARD --- */
  .doc-body {
  padding: 16px 18px 14px;
  }

  /* --- TAG DANH MỤC --- */
  .category-tag {
  display: inline-block;
  background: #eef2ff;
  color: #4f46e5;
  font-weight: 500;
  font-size: 13px;
  padding: 3px 8px;
  border-radius: 6px;
  margin-bottom: 8px;
  }

  /* --- TIÊU ĐỀ --- */
  .doc-title {
  font-size: 16px;
  font-weight: 600;
  color: #1e293b;
  margin: 4px 0 6px;
  line-height: 1.4;
  }

  /* --- NGƯỜI UPLOAD --- */
  .doc-author {
  color: #475569;
  font-size: 14px;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 4px;
 }

  /* --- THỐNG KÊ DƯỚI --- */
 .doc-stats {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13.5px;
  color: #64748b;
  border-top: 1px solid #f1f5f9;
  padding-top: 10px;
 }

 .doc-stats span {
  display: flex;
  align-items: center;
  gap: 4px;
 }
 
/* //////////////////////////////////////////////////////////// */
.doc-thumb {
  height: 160px;
  background: #ddd url('uploads/ten_anh.jpg') center/cover no-repeat;
}
.doc-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  width: 260px;
  transition: transform 0.2s ease;
  cursor: pointer;
}

.doc-card:hover {
  transform: translateY(-4px);
}

.doc-thumb {
  height: 140px; /* ảnh chỉ chiếm nửa trên */
}

.doc-body {
  padding: 15px;
  text-align: left;
}
.doc-card {
  width: 250px;
  background: white;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.doc-thumb {
  position: relative;
  width: 100%;
  height: 150px; /* đặt chiều cao cố định cho ảnh */
  overflow: hidden;
}

.doc-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* phần mờ dần ở dưới ảnh */
.doc-thumb::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 40%;
  background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, white 100%);
  pointer-events: none;
}

.doc-body {
  padding: 10px 15px;
}


    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">🎓</div>
                <div class="logo-text">StudyTogether</div>
            </div>
            
            <nav class="header-nav">
                <a href="#" class="nav-link">Trang chủ</a>
                <a href="#" class="nav-link">Danh mục</a>
                <a href="#" class="nav-link hot-link">🔥Tài liệu hot</a>
                <a href="#" class="nav-link">Về chúng tôi</a>
            </nav>

            <div class="header-actions">
                <button class="btn-upload" onclick="window.location.href='dkdn.php'">Đăng kí tài khoản</button>

                <?php if ($isLoggedIn): ?>
                    <div class="user-avatar"><?php echo $user['avatar']; ?></div>
                <?php else: ?>
                    <button class="btn-upload" 
                        style="background: white; color: #667eea; border: 2px solid #667eea;"
                        onclick="window.location.href='dkdn.php'">
                        Đăng nhập
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>🎓 Cùng nhau học tập hiệu quả hơn!</h1>
            <p>Nền tảng chia sẻ tài liệu học tập miễn phí cho sinh viên Việt Nam</p>
            
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Tìm kiếm tài liệu, môn học, giáo trình...">
                <button class="search-btn">🔍 Tìm kiếm</button>
            </div>
        </div>
    </section>

    <!-- 🧱 Bố cục 3 phần chính -->
   
        <div class="main-layout">
            <!-- Cột 1: Bài viết admin -->
            <div class="column">
                <h2>📰 Bài viết từ Admin</h2>
                <div class="doc-card">📢 Cập nhật tính năng mới</div>
                <div class="doc-card">💡 Hướng dẫn đăng tài liệu</div>
                <div class="doc-card">🧠 Mẹo học tập hiệu quả</div>
            </div>

       
           <!-- Cột 2: Card tài liệu -->
<div class="column" id="main-content">
    <h2>🔥 Tài liệu phổ biến</h2>
    <div class="cards-container">
        <?php
        include 'connect.php';

        $sql = "SELECT t.*, d.tendanhmuc, u.hoten 
                FROM tailieu t
                LEFT JOIN danhmuc d ON t.danhmucid = d.id
                LEFT JOIN users u ON t.nguoiupload = u.id
                WHERE t.trangthai = 'daduyet'
                ORDER BY t.id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                // ✅ Thư mục chứa ảnh thực tế
                $uploadPath = __DIR__ . "/uploads/";
                $webPath    = "php/uploads/"; // đường dẫn dùng cho trình duyệt

  $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

    // ✅ Sửa lại đường dẫn file thật — KHÔNG thêm "php/" nữa
    if (!empty($row['trangbia']) && file_exists(__DIR__ . "/uploads/" . $row['trangbia'])) {
    $thumbnail = $basePath . "/uploads/" . $row['trangbia'];
   } else {
    $thumbnail = $basePath . "/uploads/default-doc.jpg";
   }


                // ✅ Hiển thị card tài liệu
                echo '
                <div class="doc-card" onclick="hienThiChiTietTaiLieu(' . $row['id'] . ')">
                   <div class="doc-thumb" style="
    background: url(\'' . htmlspecialchars($thumbnail) . '\') center/cover no-repeat;
"></div>

                    <div class="doc-body">
                        <span class="category-tag">' . htmlspecialchars($row['tendanhmuc'] ?? 'Chưa có') . '</span>
                        <h3 class="doc-title">' . htmlspecialchars($row['tentailieu']) . '</h3>
                        <p class="doc-author">👤 ' . htmlspecialchars($row['hoten'] ?? 'Không rõ') . '</p>
                        <div class="doc-stats">
                            <span title="Lượt xem">👁️ ' . number_format($row['luotxem'] ?? 0) . '</span>
                            <span 
                                title="Lượt tải xuống" 
                                onclick="event.stopPropagation(); window.location.href=\'download.php?id=' . $row['id'] . '\'">
                                📥 ' . number_format($row['luottaixuong'] ?? 0) . '
                            </span>
                            <span title="Đánh giá">⭐ ' . number_format($row['danhgia'] ?? 4.5, 1) . '</span>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p>Chưa có tài liệu nào được duyệt.</p>";
        }
        ?>
    </div>
</div>



            <!-- Cột 3: Tài liệu mới nhất -->
            <div class="column">
                <h2>📄 Tài liệu mới nhất</h2>
                <ul>
                    <li>Python Machine Learning 2025</li>
                    <li>TOEIC Listening Practice</li>
                    <li>Marketing căn bản</li>
                    <li>Data Structures & Algorithms</li>
                </ul>

                <h2>🏅 Người đóng góp xuất sắc</h2>
                <ul>
                    <li>Nguyễn Văn A</li>
                    <li>Trần Thị B</li>
                    <li>Phạm Văn C</li>
                </ul>
            </div>
        </div>
    

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>🎓 StudyTogether</h3>
                <p>Nền tảng chia sẻ tài liệu học tập hàng đầu Việt Nam. Cùng nhau học tập và phát triển!</p>
            </div>
            <div class="footer-section">
                <h3>Liên kết</h3>
                <a href="#" class="footer-link">Về chúng tôi</a>
                <a href="#" class="footer-link">Điều khoản</a>
                <a href="#" class="footer-link">Chính sách</a>
                <a href="#" class="footer-link">Liên hệ</a>
            </div>
            <div class="footer-section">
                <h3>Danh mục</h3>
                <a href="#" class="footer-link">Lập trình</a>
                <a href="#" class="footer-link">Toán học</a>
                <a href="#" class="footer-link">Ngoại ngữ</a>
                <a href="#" class="footer-link">Kinh tế</a>
            </div>
            <div class="footer-section">
                <h3>Theo dõi</h3>
                <a href="#" class="footer-link">Facebook</a>
                <a href="#" class="footer-link">Twitter</a>
                <a href="#" class="footer-link">Instagram</a>
                <a href="#" class="footer-link">YouTube</a>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 StudyTogether. All rights reserved.
        </div>
    </footer>


<script>
function hienThiChiTietTaiLieu(id) {
    // Gửi yêu cầu lấy chi tiết tài liệu
    fetch('chitiet_tailieu.php?id=' + id)
        .then(res => res.text())
        .then(html => {
            document.getElementById('main-content').innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            document.getElementById('main-content').innerHTML = '<p>Lỗi tải chi tiết tài liệu.</p>';
        });

    // Gọi API tăng lượt xem
    fetch('update_luotxem.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + encodeURIComponent(id)
    })
    .then(res => res.json())
    .then(data => console.log('Lượt xem +1'))
    .catch(err => console.error(err));
}

function tangLuotTai(id, tenfile) {
    // Gọi API tăng lượt tải
    fetch('update_luottaixuong.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + encodeURIComponent(id)
    })
    .then(res => res.json())
    .then(data => {
        console.log('Lượt tải +1');
        alert('📥 Đang tải xuống...');
        // Sau này mở link tải file thật:
        if (tenfile) {
            window.location.href = 'uploads/' + tenfile;
        }
    })
    .catch(err => console.error(err));
}
</script>


</body>
</html>
