document.addEventListener("DOMContentLoaded", function () {
  fetch("load_danhmuc.php")
    .then((response) => response.json())
    .then((data) => {
      const select = document.getElementById("danhMucSelect");
      select.innerHTML = '<option value="">Chọn danh mục</option>';

      if (data.length === 0) {
        const option = document.createElement("option");
        option.textContent = "Chưa có danh mục";
        select.appendChild(option);
        return;
      }

      data.forEach((dm) => {
        const option = document.createElement("option");
        option.value = dm.id;
        option.textContent = `${dm.tendanhmuc} ${dm.icon || ""}`;
        select.appendChild(option);
      });
    })
    .catch((error) => console.error("Lỗi load danh mục:", error));
});
