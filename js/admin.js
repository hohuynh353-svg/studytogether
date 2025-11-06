document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll(".nav-link");
  const contentArea = document.getElementById("content-area");

  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      navLinks.forEach((l) => l.classList.remove("active"));
      link.classList.add("active");
      showTable(link.dataset.section);
    });
  });

  // =============================
  //  HIỂN THỊ BẢNG TÀI LIỆU
  // =============================
  function showTable(section) {
    if (section !== "documents") {
      contentArea.innerHTML = `<p class="text-center text-muted mt-5">Đang phát triển...</p>`;
      return;
    }

    contentArea.innerHTML = `
      <div class="table-header d-flex justify-content-between align-items-center mb-3">
        <h4>Quản lý tài liệu</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
          <i class="fas fa-plus"></i> Thêm tài liệu
        </button>
      </div>
      <table class="table table-striped align-middle">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Ảnh bìa</th>
            <th>Tên tài liệu</th>
            <th>Danh mục</th>
            <th>Người upload</th>
            <th>File</th>
            <th>Phí</th>
            <th>Ngày upload</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    `;

    const tbody = contentArea.querySelector("tbody");

    fetch("load_tailieu_admin.php")
      .then((res) => res.json())
      .then((data) => {
        if (!data.success || data.data.length === 0) {
          tbody.innerHTML = `<tr><td colspan="10" class="text-center text-muted">Chưa có tài liệu</td></tr>`;
          return;
        }

        data.data.forEach((item) => {
          const disabled =
            item.trangthai === "daduyet" || item.trangthai === "tuchoi"
              ? "disabled"
              : "";

          const trangbiaHTML = item.trangbia
            ? `<img src="uploads/${item.trangbia}" alt="Bìa" 
          style="width:80px;height:100px;object-fit:cover;border-radius:8px;">`
            : `<span class="text-muted small">Chưa có</span>`;

          const fileHTML = item.fileupload
            ? `<a href="${item.fileupload}" target="_blank" class="btn btn-sm btn-outline-primary">Xem file</a>`
            : `<span class="text-danger small">Không có file</span>`;

          tbody.innerHTML += `
            <tr data-id="${item.id}">
              <td>${item.id}</td>
              <td>${trangbiaHTML}</td>
              <td>${item.tentailieu}</td>
              <td>${item.ten_danh_muc || "-"}</td>
              <td>${item.ten_nguoi_upload || "-"}</td>
              <td>${fileHTML}</td>
              <td>${item.phi}</td>
              <td>${item.ngayupload}</td>
              <td>
                <select class="form-select form-select-sm trangthai-select" data-id="${
                  item.id
                }" ${disabled}>
                  <option value="choduyet" ${
                    item.trangthai === "choduyet" ? "selected" : ""
                  }>⏳ Chờ duyệt</option>
                  <option value="daduyet" ${
                    item.trangthai === "daduyet" ? "selected" : ""
                  }>✅ Đã duyệt</option>
                  <option value="tuchoi" ${
                    item.trangthai === "tuchoi" ? "selected" : ""
                  }>❌ Từ chối</option>
                </select>
              </td>
              <td>
                <button class="btn btn-sm btn-warning btn-edit">Sửa</button>
                <button class="btn btn-sm btn-danger btn-delete">Xóa</button>
              </td>
            </tr>`;
        });

        // Gắn sự kiện
        document.querySelectorAll(".trangthai-select").forEach((sel) => {
          sel.addEventListener("change", () => updateStatus(sel));
        });
        document.querySelectorAll(".btn-delete").forEach((btn) => {
          btn.addEventListener("click", () => deleteDoc(btn));
        });
        document.querySelectorAll(".btn-edit").forEach((btn) => {
          btn.addEventListener("click", handleEditDocument);
        });
      });
  }

  // =============================
  //   SỬA TÀI LIỆU
  // =============================
  function handleEditDocument(e) {
    const row = e.target.closest("tr");
    const id = row.dataset.id;
    const tentailieu = row.children[2].textContent.trim();
    const danhMuc = row.children[3].textContent.trim();
    const phi = row.children[6].textContent.trim();
    const fileLink = row.querySelector("a");

    document.getElementById("edit_id").value = id;
    document.getElementById("edit_tentailieu").value = tentailieu;
    document.getElementById("edit_phi").value = phi;
    document.getElementById("filePreview").innerHTML = fileLink
      ? fileLink.outerHTML
      : "<span class='text-muted'>Không có file</span>";

    fetch("load_danhmuc.php")
      .then((res) => res.json())
      .then((data) => {
        const select = document.getElementById("edit_danhmuc");
        select.innerHTML = "";
        data.forEach((dm) => {
          const opt = document.createElement("option");
          opt.value = dm.id;
          opt.textContent = dm.tendanhmuc;
          if (dm.tendanhmuc === danhMuc) opt.selected = true;
          select.appendChild(opt);
        });
      });

    const modal = new bootstrap.Modal(document.getElementById("editModal"));
    modal.show();
  }

  // Lưu thay đổi sau khi sửa
  document
    .getElementById("btnSaveEdit")
    .addEventListener("click", handleSaveEdit);
  function handleSaveEdit() {
    const id = document.getElementById("edit_id").value;
    const tentailieu = document.getElementById("edit_tentailieu").value;
    const phi = document.getElementById("edit_phi").value;
    const danhmucid = document.getElementById("edit_danhmuc").value;
    const file = document.getElementById("edit_file").files[0];

    const formData = new FormData();
    formData.append("id", id);
    formData.append("tentailieu", tentailieu);
    formData.append("phi", phi);
    formData.append("danhmucid", danhmucid);
    if (file) formData.append("file", file);

    fetch("update_tailieu.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((result) => {
        alert(result.message);
        if (result.success) {
          bootstrap.Modal.getInstance(
            document.getElementById("editModal")
          ).hide();
          showTable("documents");
        }
      })
      .catch((err) => console.error("Lỗi cập nhật:", err));
  }

  // =============================
  //  THÊM TÀI LIỆU
  // =============================
  document
    .getElementById("addDocumentModal")
    .addEventListener("show.bs.modal", () => {
      fetch("load_danhmuc.php")
        .then((res) => res.json())
        .then((data) => {
          const sel = document.getElementById("danh_muc");
          sel.innerHTML = '<option value="">Chọn danh mục</option>';
          data.forEach((dm) => {
            sel.innerHTML += `<option value="${dm.id}">${dm.tendanhmuc}</option>`;
          });
        });
    });

  document.getElementById("addDocumentForm").addEventListener("submit", (e) => {
    e.preventDefault();
    const fd = new FormData(e.target);

    fetch("add_document.php", { method: "POST", body: fd })
      .then((res) => res.json())
      .then((r) => {
        alert(r.message);
        if (r.success) {
          e.target.reset();
          bootstrap.Modal.getInstance(
            document.getElementById("addDocumentModal")
          ).hide();
          showTable("documents");
        }
      });
  });

  // =============================
  //  XÓA & TRẠNG THÁI
  // =============================
  function updateStatus(select) {
    const id = select.dataset.id;
    const newStatus = select.value;
    if (!confirm(`Xác nhận thay đổi trạng thái tài liệu #${id}?`)) return;

    fetch("update_trangthai.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id, trangthai: newStatus }),
    })
      .then((res) => res.json())
      .then((r) => {
        alert(r.message);
        if (r.success && (newStatus === "daduyet" || newStatus === "tuchoi"))
          select.disabled = true;
      });
  }

  function deleteDoc(btn) {
    const id = btn.closest("tr").dataset.id;
    if (!confirm("Xác nhận xóa?")) return;

    fetch(`delete_tailieu.php?id=${id}`)
      .then((res) => res.json())
      .then((r) => {
        alert(r.message);
        if (r.success) btn.closest("tr").remove();
      });
  }

  // Mặc định mở tab tài liệu
  showTable("documents");
});
