<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tendanhmuc = $_POST["name"];
    $conn = mysqli_connect("localhost", "root", "", "doancoso2");
    $sql = "INSERT INTO category (name) VALUES ('$tendanhmuc')";
    $kq = mysqli_query($conn, $sql);
  }
?>
<?php require '../../layouts/header.php' ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Thêm mới danh mục</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="/DoAnCoSo2/admin/modules/category">Danh mục</a></li>
      <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <form class="form-horizontal" action="add.php" method="POST">
      <div class="form-group" style="text-align: center">
        <label class="col-sm-1 control-label">Tên danh mục</label>
        <div class="col-sm-10" style="display: inline-block">
          <input type="text" class="form-control" placeholder="Tên danh mục" name="name">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary" style="margin: 2% 0% 0% 15%">Lưu</button>
        </div>
      </div>
    </form>
  </div>
</main>
<?php require '../../layouts/footer.php' ?>