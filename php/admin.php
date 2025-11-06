
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="../css/admin.css">


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

<!-- ========== MODALS ========== -->

<!-- Modal Thêm Tài Liệu -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <form id="addDocumentForm" enctype="multipart/form-data">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Thêm Tài Liệu Mới</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
      <!-- Tên tài liệu -->
      <div class="mb-3">
        <label for="ten_tai_lieu" class="form-label">Tên tài liệu</label>
        <input type="text" id="ten_tai_lieu" name="ten_tai_lieu" class="form-control" required>
      </div>

      <!-- Danh mục -->
      <div class="mb-3">
        <label for="danh_muc" class="form-label">Danh mục</label>
        <select id="danh_muc" name="danh_muc" class="form-select" required>
          <option value="">Chọn danh mục</option>
          <!-- load từ CSDL -->
        </select>
      </div>

      <!-- Phí -->
      <div class="mb-3">
        <label for="phi" class="form-label">Phí (VND)</label>
        <input type="number" id="phi" name="phi" class="form-control" required>
      </div>

      <!-- File PDF -->
      <div class="mb-3">
        <label for="file" class="form-label">Chọn file PDF</label>
        <input type="file" id="file" name="file" class="form-control" accept="application/pdf" required>
      </div>

      <!-- Ảnh bìa -->
      <div class="mb-3">
        <label for="trangbia" class="form-label">Chọn ảnh bìa (bắt buộc)</label>
        <input type="file" id="trangbia" name="trangbia" class="form-control" accept="image/*" required>
        <small class="text-danger">Vui lòng chọn ảnh bìa cho tài liệu.</small>
      </div>

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

<!-- Modal Sửa Tài Liệu -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Sửa tài liệu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
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
            <label class="form-label">Ảnh trang bìa hiện tại</label>
           <img id="thumbImage" src="" alt="Ảnh hiện tại"
     style="width:80px; height:auto; margin-top:5px; border-radius:8px; display:block;">

          </div>

          <div class="mb-3">
            <label class="form-label">Tải ảnh trang bìa mới (nếu muốn thay)</label>
            <input type="file" class="form-control" id="edit_trangbia_new" accept="image/*">
          </div>

          <div class="mb-3">
            <label class="form-label">File tài liệu hiện tại</label>
            <div id="filePreview"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Tải file mới (nếu muốn thay)</label>
            <input type="file" class="form-control" id="edit_file">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-primary" id="btnSaveEdit">💾 Lưu thay đổi</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========== SCRIPTS ========== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// ========== BIẾN TOÀN CỤC ==========
let currentSection = 'users';
const navLinks = document.querySelectorAll('.nav-link');
const contentArea = document.getElementById('content-area');
const addDocumentModal = new bootstrap.Modal(document.getElementById('addDocumentModal'));

// ========== HÀM CHÍNH ==========

// Khởi tạo dashboard
document.addEventListener('DOMContentLoaded', function() {
     let currentSection = 'documents'; 
    initEventListeners();
    showTable(currentSection);
});

// Khởi tạo event listeners
function initEventListeners() {
    // Xử lý click menu
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

    // Modal thêm tài liệu - load danh mục
    document.getElementById('addDocumentModal').addEventListener('show.bs.modal', function() {
        loadDanhMucForAddModal();
    });

    // Form thêm tài liệu
    document.getElementById('addDocumentForm').addEventListener('submit', handleAddDocument);

    // Nút lưu sửa tài liệu
    document.getElementById('btnSaveEdit').addEventListener('click', handleSaveEdit);
}

// Hiển thị bảng theo section
function showTable(section) {
    currentSection = section;
    
    const config = getTableConfig(section);
    renderTableStructure(config);
    
    if (section === 'documents') {
        loadDocumentsData();
    } else if (section === 'danhmuc') {
        loadDanhMucData();
    }
}

// ========== HÀM XỬ LÝ DỮ LIỆU ==========

// Cấu hình bảng theo section
function getTableConfig(section) {
    const configs = {
        'transactions': {
            title: 'Quản lý giao dịch tài liệu',
            headers: ['ID', 'Họ Tên', 'Ngày giao dịch', 'Phí', 'Xem chi tiết'],
            sectionName: 'Giao dịch'
        },
        'users': {
            title: 'Quản lý người dùng',
            headers: ['ID', 'Họ tên', 'Email', 'Số điện thoại', 'Ngày đăng ký', 'Thao tác'],
            sectionName: 'Người dùng'
        },
        'uploaders': {
            title: 'Quản lý người đăng tải',
            headers: ['ID', 'Họ tên', 'Email', 'Số điện thoại', 'Ngày đăng ký', 'Thao tác'],
            sectionName: 'Người đăng tải'
        },
        'documents': {
            title: 'Quản lý tài liệu',
            headers: ['ID', 'Tên tài liệu', 'Danh mục', 'Người upload', 'File Upload','Trang bìa', 'Phí', 'Ngày upload', 'Trạng thái', 'Thao tác'],
            sectionName: 'Tài liệu',
            showAddButton: true
        },
        'danhmuc': {
            title: 'Quản lý danh mục',
            headers: ['ID', 'Tên danh mục', 'Icon', 'Ngày', 'Thao tác'],
            sectionName: 'Danh mục'
        },
        'danhgia': {
            title: 'Quản lý đánh giá',
            headers: ['ID', 'Họ tên', 'Nội dung đánh giá', 'Số sao', 'Ngày đánh giá', 'Thao tác'],
            sectionName: 'Đánh giá'
        },
        'lienhe': {
            title: 'Quản lý liên hệ',
            headers: ['ID', 'Họ tên', 'Email', 'Nội dung liên hệ', 'Ngày liên hệ', 'Thao tác'],
            sectionName: 'Liên hệ'
        }
    };
    
    return configs[section] || configs['users'];
}

// Render cấu trúc bảng
function renderTableStructure(config) {
    const headerRow = '<tr>' + config.headers.map(h => `<th>${h}</th>`).join('') + '</tr>';
    const tableHeader = `
        <div class="table-header">
            <h4 class="mb-0">${config.title}</h4>
            <div class="search-container">
                <input type="text" class="form-control search-input d-inline-block" placeholder="Tìm kiếm...">
                ${config.showAddButton ? `<button class="add-btn" data-bs-toggle="modal" data-bs-target="#addDocumentModal"><i class="fas fa-plus"></i> Thêm tài liệu</button>` : ''}
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
            <p>Chưa có dữ liệu ${config.sectionName.toLowerCase()} nào.</p>
        </div>
    `;

    contentArea.innerHTML = tableHTML;
}

// ========== XỬ LÝ TÀI LIỆU ==========

/// Load dữ liệu tài liệu
function loadDocumentsData() {
    fetch('load_tailieu_admin.php')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            if (!data.success || data.data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="10" style="text-align:center;">Chưa có tài liệu nào</td></tr>`;
                return;
            }

            renderDocumentsTable(data.data, tbody);
            initDocumentEventListeners();
        })
        .catch(err => console.error('Lỗi tải dữ liệu tài liệu:', err));
}

// Render bảng tài liệu
function renderDocumentsTable(documents, tbody) {
    tbody.innerHTML = '';
    documents.forEach(item => {
        const fileHTML = getFileHTML(item);
        const coverHTML = getCoverHTML(item); // 👉 cột trang bìa
        const statusHTML = getStatusHTML(item);

        const row = `
            <tr data-id="${item.id}">
                <td>${item.id}</td>
                <td>${item.tentailieu}</td>
                <td>${item.ten_danh_muc || '—'}</td>
                <td>${item.ten_nguoi_upload || '—'}</td>
                <td>${fileHTML}</td>
                <td>${coverHTML}</td> <!-- 🖼 Cột trang bìa -->
                <td>${item.phi}</td>
                <td>${item.ngayupload}</td>
                <td>${statusHTML}</td>
                <td>
                    <button class="btn btn-sm btn-warning btn-edit">Sửa</button>
                    <button class="btn btn-sm btn-danger btn-delete">Xóa</button>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}
// ✅ Tạo HTML hiển thị file upload (đầy đủ cho ảnh, PDF, Word, và file khác)
function getFileHTML(item) {
    if (!item.fileupload) {
        return `<span class="text-danger">Không có file</span>`;
    }

    // ⚙️ Nếu PHP đã trả về đường dẫn đầy đủ (đã có http://), giữ nguyên
    const filePath = item.fileupload.startsWith('http')
        ? item.fileupload
        : `uploads/${item.fileupload}`;

    const fileExt = filePath.split('.').pop().toLowerCase();

    // 🖼️ Ảnh
    if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
        return `<img src="${filePath}" alt="${item.tentailieu}"
                 style="width:80px;height:80px;object-fit:cover;border-radius:6px;"
                 onerror="this.src='no-image.png'">`;
    }

    // 📄 PDF
    if (fileExt === 'pdf') {
        return `<iframe src="${filePath}" width="120" height="120" style="border:none;"></iframe>`;
    }

    // 📝 Word (.doc, .docx)
    if (['doc', 'docx'].includes(fileExt)) {
        return `<a href="${filePath}" target="_blank" 
                   style="text-decoration:none;color:#007bff;">
                   📝 Xem tài liệu Word
                </a>`;
    }

    // 📎 Các loại file khác
    return `<a href="${filePath}" target="_blank">📎 Tải xuống</a>`;
}


// ✅ Tạo HTML hiển thị trang bìa 
function getCoverHTML(item) {
    if (!item.trangbia) return '<span class="text-muted">—</span>';
    return `<img src="uploads/${item.trangbia}" alt="Trang bìa"
                style="width:80px;height:80px;object-fit:cover;border-radius:6px;">`;
}


// Tạo HTML cho trạng thái
function getStatusHTML(item) {
    const isApproved = item.trangthai === 'daduyet';
    const isRejected = item.trangthai === 'tuchoi';
    
    return `
        <select class="form-select form-select-sm trangthai-select" data-id="${item.id}" 
                ${isApproved || isRejected ? 'disabled' : ''}>
            <option value="choduyet" ${item.trangthai === 'choduyet' ? 'selected' : ''}>⏳ Chờ duyệt</option>
            <option value="daduyet" ${item.trangthai === 'daduyet' ? 'selected' : ''}>✅ Đã duyệt</option>
            <option value="tuchoi" ${item.trangthai === 'tuchoi' ? 'selected' : ''}>❌ Từ chối</option>
        </select>
    `;
}

// Khởi tạo event listeners cho tài liệu
function initDocumentEventListeners() {
    // Xử lý thay đổi trạng thái
    document.querySelectorAll('.trangthai-select').forEach(select => {
        select.addEventListener('change', handleStatusChange);
    });

    // Xử lý xóa tài liệu
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', handleDeleteDocument);
    });

    // Xử lý sửa tài liệu
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', handleEditDocument);
    });
}

// ========== EVENT HANDLERS ==========

// Xử lý thay đổi trạng thái
function handleStatusChange(e) {
    const select = e.target;
    const id = select.dataset.id;
    const newStatus = select.value;

    if (!confirm(`Xác nhận thay đổi trạng thái tài liệu #${id} thành "${select.options[select.selectedIndex].text}"?`)) {
        location.reload();
        return;
    }

    fetch('update_trangthai.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id, trangthai: newStatus })
    })
    .then(res => res.json())
    .then(result => {
        alert(result.message);
        if (result.success && (newStatus === 'daduyet' || newStatus === 'tuchoi')) {
            select.disabled = true;
        }
    })
    .catch(err => console.error('Lỗi cập nhật trạng thái:', err));
}

// Xử lý xóa tài liệu
function handleDeleteDocument(e) {
    const id = e.target.closest('tr').dataset.id;
    if (confirm('Bạn có chắc muốn xóa tài liệu này không?')) {
        fetch(`delete_tailieu.php?id=${id}`, { method: 'GET' })
            .then(res => res.json())
            .then(result => {
                alert(result.message);
                if (result.success) e.target.closest('tr').remove();
            });
    }
}

// Xử lý sửa tài liệu
function handleEditDocument(e) {
    const row = e.target.closest('tr');
    const id = row.dataset.id;
    const tentailieu = row.children[1].textContent;
    const danhMuc = row.children[2].textContent;
    const phi = row.children[5].textContent;
    const fileLink = row.querySelector('a, img, iframe');

    // 👉 Lấy đường dẫn ảnh trang bìa (nếu có)
    // Giả sử trong bảng bạn có cột chứa ảnh (vd: cột 3 hoặc có class 'thumb')
    const thumbCell = row.querySelector('img'); // lấy ảnh đầu tiên trong dòng
    const thumbSrc = thumbCell ? thumbCell.getAttribute('src') : 'php/uploads/default-doc.jpg';

    // Điền dữ liệu vào modal
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_tentailieu').value = tentailieu;
    document.getElementById('edit_phi').value = phi;

    // Hiển thị file hiện tại
    document.getElementById('filePreview').innerHTML = fileLink
        ? fileLink.outerHTML
        : 'Không có file';

    // ✅ Hiển thị ảnh trang bìa hiện tại
    const thumbImage = document.getElementById('thumbImage');
    if (thumbImage) thumbImage.src = thumbSrc;

    // Load danh mục cho modal sửa
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

    // Hiển thị modal
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
}

// Xử lý thêm tài liệu
function handleAddDocument(e) {
    e.preventDefault();
    const formData = new FormData(e.target);

    fetch('add_document.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('✅ Thêm tài liệu thành công!');
            e.target.reset();
            const modal = bootstrap.Modal.getInstance(document.getElementById('addDocumentModal'));
            modal.hide();
            showTable('documents');
        } else {
            alert('❌ Lỗi: ' + data.message);
        }
    })
    .catch(err => {
        console.error('Lỗi gửi form:', err);
        alert('Không thể thêm tài liệu.');
    });
}

// Xử lý lưu sửa tài liệu
function handleSaveEdit() {
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
}
document.addEventListener("DOMContentLoaded", () => {
  const btnSave = document.getElementById("btnSaveEdit");
  if (btnSave) {
    btnSave.addEventListener("click", handleSaveEdit);
  }
});


// ========== XỬ LÝ DANH MỤC ==========

// Load danh mục cho modal thêm
function loadDanhMucForAddModal() {
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
}

// Load dữ liệu danh mục
function loadDanhMucData() {
    const tbody = document.querySelector('tbody');
    const emptyState = document.querySelector('.empty-state');

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
</script>

</body>
</html>
