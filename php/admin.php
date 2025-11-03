
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #343a40 0%, #495057 100%);
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            z-index: 1000;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 20px;
            border-radius: 0 15px 15px 0;
            margin: 5px 0;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #007bff;
            transform: translateX(5px);
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .header {
            background: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h2 {
            margin: 0;
        }
        .logout-btn {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #c82333;
            color: white;
            text-decoration: none;
        }
        .logout-btn i {
            margin-right: 5px;
        }
        .table-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            overflow-x: auto;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px;
        }
        .table td {
            padding: 15px;
            border-color: #dee2e6;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        .empty-state i {
            font-size: 48px;
            margin-bottom: 10px;
            opacity: 0.5;
        }
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .search-input {
            max-width: 300px;
            height: 38px;
        }
        .add-btn {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            height: 38px;
            line-height: 1.5;
            white-space: nowrap;
            transition: background-color 0.3s ease;
        }
        .add-btn:hover {
            background-color: #218838;
            color: white;
        }
        .add-btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-white text-center mb-4">Admin Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="index.php" data-section="trangchu">
                    <i class="fas fa-home"></i> Trang chủ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="users">
                    <i class="fas fa-users"></i> Quản lý người dùng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="uploaders">
                    <i class="fas fa-upload"></i> Quản lý người đăng tải
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="transactions">
                    <i class="fas fa-exchange-alt"></i> Quản lý giao dịch tài liệu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="documents">
                    <i class="fas fa-file-alt"></i> Quản lý tài liệu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="danhmuc">
                    <i class="fas fa-file-alt"></i> Quản lý danh mục
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="danhgia">
                    <i class="fas fa-star"></i> Quản lý đánh giá
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="lienhe">
                    <i class="fas fa-address-book"></i> Quản lý liên hệ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="thongke">
                    <i class="fas fa-chart-bar"></i> Thống kê
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="chatbox">
                    <i class="fas fa-comments"></i> Chat
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <div>
                <h2>Chào mừng đến với Admin Dashboard</h2>
                <p class="text-muted mb-0">Chọn một phần quản lý từ menu bên trái để xem chi tiết.</p>
            </div>
            <a href="#" class="logout-btn" title="Đăng xuất">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </div>
        <div class="table-container">
            <div id="content-area">
                <div class="empty-state">
                    <i class="fas fa-table"></i>
                    <h5>Chào mừng đến với Admin Dashboard</h5>
                    <p>Chọn một phần quản lý từ menu bên trái để xem chi tiết.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal cho form thêm tài liệu -->
   <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addDocumentForm" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm Tài Liệu Mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="ten_tai_lieu" class="form-label">Tên tài liệu</label>
            <input type="text" id="ten_tai_lieu" name="ten_tai_lieu" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="danh_muc" class="form-label">Danh mục</label>
            <select id="danh_muc" name="danh_muc" class="form-select" required>
              <option value="">Chọn danh mục</option>
              <!-- load từ CSDL -->
            </select>
          </div>

          <div class="mb-3">
            <label for="phi" class="form-label">Phí (VND)</label>
            <input type="number" id="phi" name="phi" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="file" class="form-label">Chọn file</label>
            <input type="file" id="file" name="file" class="form-control" required>
          </div>

          <!-- 👇 thêm user_id -->
          <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
      </div>
    </form>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script>
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    const contentArea = document.getElementById('content-area');
    const addDocumentModal = new bootstrap.Modal(document.getElementById('addDocumentModal'));

    function showTable(section) {
        let title = '';
        let headers = [];
        let sectionName = '';
        let showAddButton = false;

        switch(section) {
            case 'transactions':
                title = 'Quản lý giao dịch tài liệu';
                headers = ['ID','Họ Tên','Ngày giao dịch','Phí' ,'Xem chi tiết'];
                sectionName = 'Giao dịch';
                break;
            case 'users':
                title = 'Quản lý người dùng';
                headers = ['ID', 'Họ tên', 'Email', 'Số điện thoại', 'Ngày đăng ký', 'Thao tác'];
                sectionName = 'Người dùng';
                break;
            case 'uploaders':
                title = 'Quản lý người đăng tải';
                headers = ['ID', 'Họ tên', 'Email', 'Số điện thoại', 'Ngày đăng ký', 'Thao tác'];
                sectionName = 'Người đăng tải';
                break;
      case 'documents':
    title = 'Quản lý tài liệu';
    headers = ['ID', 'Tên tài liệu', 'Danh mục', 'Người upload', 'File Upload', 'Phí', 'Ngày upload', 'Thao tác'];
    sectionName = 'Tài liệu';
    showAddButton = true;

    // Gọi API load dữ liệu
    fetch('load_tailieu.php')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            if (!data.success || data.data.length === 0) {
                tbody.innerHTML = `
                    <tr><td colspan="8" style="text-align:center;">Chưa có tài liệu nào</td></tr>
                `;
                return;
            }

            data.data.forEach(item => {
                const filePath = `uploads/${item.fileupload}`;
                const fileExt = item.fileupload.split('.').pop().toLowerCase();
                let fileHTML = '';

                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
                    fileHTML = `<img src="${filePath}" alt="${item.tentailieu}" style="width:80px;height:80px;object-fit:cover;border-radius:6px;">`;
                } else if (fileExt === 'pdf') {
                    fileHTML = `<iframe src="${filePath}" width="120" height="120" style="border:none;"></iframe>`;
                } else {
                    fileHTML = `<a href="${filePath}" target="_blank">📎 ${item.fileupload}</a>`;
                }

                const row = `
                    <tr data-id="${item.id}">
                        <td>${item.id}</td>
                        <td>${item.tentailieu}</td>
                        <td>${item.ten_danh_muc || '—'}</td>
                        <td>${item.ten_nguoi_upload || '—'}</td>
                        <td>${fileHTML}</td>
                        <td>${item.phi}</td>
                        <td>${item.ngayupload}</td>
                        <td>
                            <button class="btn btn-sm btn-warning btn-edit">Sửa</button>
                            <button class="btn btn-sm btn-danger btn-delete">Xóa</button>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });

            // 🟡 Xử lý nút XÓA
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.closest('tr').dataset.id;
                    if (confirm('Bạn có chắc muốn xóa tài liệu này không?')) {
                        fetch(`delete_tailieu.php?id=${id}`, { method: 'GET' })
                            .then(res => res.json())
                            .then(result => {
                                alert(result.message);
                                if (result.success) btn.closest('tr').remove();
                            });
                    }
                });
            });

            
            // 🟢 Xử lý nút SỬA
document.querySelectorAll('.btn-edit').forEach(btn => {
  btn.addEventListener('click', () => {
    const row = btn.closest('tr');
    const id = row.dataset.id;

    // Lấy dữ liệu hiện tại
    const tentailieu = row.children[1].textContent;
    const phi = row.children[5].textContent;
    const danhMuc = row.children[2].textContent;
    const fileLink = row.querySelector('a, img, iframe');

    // Đổ dữ liệu lên modal
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_tentailieu').value = tentailieu;
    document.getElementById('edit_phi').value = phi;
    document.getElementById('filePreview').innerHTML = fileLink ? fileLink.outerHTML : 'Không có file';

    // Tải danh mục để chọn
    fetch('load_danhmuc.php')
      .then(res => res.json())
      .then(danhmucs => {
        const select = document.getElementById('edit_danhmuc');
        select.innerHTML = '';
        danhmucs.forEach(dm => {
          const opt = document.createElement('option');
          opt.value = dm.id;
          opt.textContent = dm.tendanhmuc;
          if (dm.tendanhmuc === danhMuc) opt.selected = true;
          select.appendChild(opt);
        });
      });

    // Mở modal
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
  });
});
document.getElementById('btnSaveEdit').addEventListener('click', () => {
  const id = document.getElementById('edit_id').value;
  const tentailieu = document.getElementById('edit_tentailieu').value;
  const phi = document.getElementById('edit_phi').value;
  const danhmucid = document.getElementById('edit_danhmuc').value;
  const file = document.getElementById('edit_file').files[0];

  const formData = new FormData();
  formData.append('id', id);
  formData.append('tentailieu', tentailieu);
  formData.append('phi', phi);
  formData.append('danhmucid', danhmucid);
  if (file) formData.append('file', file);

  fetch('update_tailieu.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.json())
    .then(result => {
      alert(result.message);
      if (result.success) location.reload();
    })
    .catch(err => console.error('Lỗi cập nhật:', err));
});

        })
        .catch(err => console.error('Lỗi tải dữ liệu tài liệu:', err));
    break;


            case 'danhmuc':
                title = 'Quản lý danh mục';
                headers = ['ID', 'Tên danh mục', 'Icon', 'Ngày','Thao tác'];
                sectionName = 'Danh mục';
                break;
            case 'danhgia':
                title = 'Quản lý đánh giá';
                headers = ['ID', 'Họ tên', 'Nội dung đánh giá', 'Số sao', 'Ngày đánh giá','Thao tác'];
                sectionName = 'Đánh giá';
                break;
            case 'lienhe':
                title = 'Quản lý liên hệ';
                headers = ['ID', 'Họ tên', 'Email','Nội dung liên hệ', 'Ngày liên hệ','Thao tác'];
                sectionName = 'Liên hệ';
                break;
        }

        let headerRow = '<tr>' + headers.map(h => `<th>${h}</th>`).join('') + '</tr>';
        let tableHeader = `
            <div class="table-header">
                <h4 class="mb-0">${title}</h4>
                <div class="search-container">
                    <input type="text" class="form-control search-input d-inline-block" placeholder="Tìm kiếm...">
                    ${showAddButton ? `<button class="add-btn" data-bs-toggle="modal" data-bs-target="#addDocumentModal"><i class="fas fa-plus"></i> Thêm tài liệu</button>` : ''}
                </div>
            </div>
        `;

        const tableHTML = `
            ${tableHeader}
            <table class="table table-striped mt-3">
                <thead>${headerRow}</thead>
                <tbody></tbody>
            </table>
            <div class="empty-state mt-3">
                <i class="fas fa-inbox"></i>
                <p>Chưa có dữ liệu ${sectionName.toLowerCase()} nào.</p>
            </div>
        `;

        contentArea.innerHTML = tableHTML;

        // ✅ Di chuyển phần load danh mục vào trong đây để tránh lỗi "section is not defined"
        if (section === 'danhmuc') {
            const tbody = contentArea.querySelector('tbody');
            const emptyState = contentArea.querySelector('.empty-state');

            fetch('load_danhmuc.php')
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        emptyState.style.display = 'none';
                        data.forEach(dm => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>${dm.id}</td>
                                <td>${dm.tendanhmuc}</td>
                                <td>${dm.icon}</td>
                                <td>${dm.created_at}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">Sửa</button>
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </td>
                            `;
                            tbody.appendChild(tr);
                        });
                    }
                })
                .catch(err => console.error('Lỗi load danh mục:', err));
        }
    }

    // Xử lý sự kiện click trên menu
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const section = this.getAttribute('data-section');
            if (section === 'trangchu') {
                window.location.href = this.getAttribute('href');
            } else {
                e.preventDefault();
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                showTable(section);
            }
        });
    });

    // Mặc định hiển thị trang người dùng
    showTable('users');
    // Khi mở modal Thêm Tài Liệu Mới → tự động load danh mục
document.getElementById('addDocumentModal').addEventListener('show.bs.modal', function () {
  const select = document.getElementById('danh_muc');
  fetch('load_danhmuc.php')
    .then(res => res.json())
    .then(data => {
      select.innerHTML = '<option value="">Chọn danh mục</option>';
      data.forEach(dm => {
        select.innerHTML += `<option value="${dm.id}">${dm.tendanhmuc}</option>`;
      });
    })
    .catch(err => console.error('Lỗi load danh mục:', err));
});

// Hiển thị mặc định cho trang admin
showTable('users');


    // Xử lý form thêm tài liệu
const addDocumentForm = document.getElementById('addDocumentForm');

addDocumentForm.addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(addDocumentForm);

  fetch('add_document.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert('✅ Thêm tài liệu thành công!');
      addDocumentForm.reset();
      const modal = bootstrap.Modal.getInstance(document.getElementById('addDocumentModal'));
      modal.hide();
      // Reload lại bảng tài liệu
      showTable('documents');
    } else {
      alert('❌ Lỗi: ' + data.message);
    }
  })
  .catch(err => {
    console.error('Lỗi gửi form:', err);
    alert('Không thể thêm tài liệu.');
  });
});

});
</script>
<!-- dropdown danhmuc -->


<script>
document.addEventListener("DOMContentLoaded", function () {
  fetch("load_danhmuc.php")
    .then(response => response.json())
    .then(data => {
      const select = document.getElementById("danhMucSelect");

      if (data.length === 0) {
        const option = document.createElement("option");
        option.textContent = "Chưa có danh mục";
        select.appendChild(option);
        return;
      }

      data.forEach(dm => {
        const option = document.createElement("option");
        option.value = dm.id;
        // hiện cả tên và icon (nếu có)
        option.textContent = `${dm.tendanhmuc} ${dm.icon || ""}`;
        select.appendChild(option);
      });
    })
    .catch(error => console.error("Lỗi load danh mục:", error));
});
</script>



<!-- Modal Sửa Tài Liệu -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Sửa tài liệu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="edit_id">

          <div class="mb-3">
            <label class="form-label">Tên tài liệu</label>
            <input type="text" class="form-control" id="edit_tentailieu" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Phí</label>
            <input type="number" class="form-control" id="edit_phi" step="0.01" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select id="edit_danhmuc" class="form-select"></select>
          </div>

          <div class="mb-3">
            <label class="form-label">File hiện tại</label>
            <div id="filePreview"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Tải file mới (nếu muốn thay)</label>
            <input type="file" class="form-control" id="edit_file">
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-warning" id="btnSaveEdit">Lưu thay đổi</button>
      </div>
    </div>
  </div>
</div>

  


</body>
</html>
