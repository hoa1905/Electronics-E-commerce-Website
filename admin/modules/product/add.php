<style type="text/css">
  .form-group {
    margin-top: 20px
  }
</style>
<?php $conn = mysqli_connect("localhost", "root", "", "doancoso2") ?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_category = $_POST['id_category'];
    $tensanpham = $_POST['name'];
    $gia = $_POST['price'];
    $soluong = $_POST['number'];
    $hinhanh = $_FILES['image'];
    $noidung = $_POST['content'];

    $folder = '../../../public/frontend/images/';
    // $file_extension = explode('.', $hinhanh['name'])[1];
    // $file_name = time() . '.' . $file_extension;
    // $path_file = $folder . $file_name;
    $file_name = basename($hinhanh['name']);
    $path_file = $folder . $file_name;

    move_uploaded_file($hinhanh['tmp_name'], $path_file);

    $sql = "INSERT INTO products (id_category, name, price, number, image, content) VALUES ($id_category, '$tensanpham', $gia, $soluong, '$file_name', '$noidung')";
    $kq = mysqli_query($conn, $sql);
  }
?>
<?php require '../../layouts/header.php' ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Thêm mới sản phẩm</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="/DoAnCoSo2/admin/modules/product">Sản phẩm</a></li>
      <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <form class="form-horizontal" action="add.php" method="POST" enctype="multipart/form-data">
      <div class="form-group" style="text-align: center">
        <label class="col-sm-1 control-label">Danh mục</label>
        <div class="col-sm-9" style="display: inline-block">
          <select class="form-control col-sm10" name="id_category">
            <option value="">Mời bạn chọn danh mục sản phẩm</option>
            <?php
              $sql = "SELECT * FROM category";
              $kq = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_array($kq))
                echo '<option value = "' . $row['id'] . '">' . $row['name'] . '</option>'
            ?>
          </select>
        </div>
      </div>
      <div class="form-group" style="text-align: center">
        <label class="col-sm-1 control-label">Tên sản phẩm</label>
        <div class="col-sm-9" style="display: inline-block">
          <input type="text" class="form-control" placeholder="Tên sản phẩm" name="name">
        </div>
      </div>
      <div class="form-group" style="text-align: center">
        <label class="col-sm-1 control-label">Giá sản phẩm</label>
        <div class="col-sm-9" style="display: inline-block">
          <input type="number" class="form-control" placeholder="0" name="price">
        </div>
      </div>
      <div class="form-group" style="text-align: center">
        <label class="col-sm-1 control-label">Số lượng</label>
        <div class="col-sm-9" style="display: inline-block">
          <input type="number" class="form-control" placeholder="0" name="number">
        </div>
      </div>
      <div class="form-group" style="text-align: center">
        <label class="col-sm-1 control-label">Hình ảnh</label>
        <div class="col-sm-9" style="display: inline-block">
          <input type="file" class="form-control" name="image">
        </div>
      </div>
      <div class="form-group" style="text-align: center">
        <label class="col-sm-1 control-label" style="vertical-align: top;">Nội dụng</label>
        <div id="editor" name="content">
          <p>dddđ</p>
        </div>
        <script>
          ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
              console.error(error);
            });
        </script>
      </div>


      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary" style="margin-left: 20%">Lưu</button>
        </div>
      </div>
    </form>
  </div>
</main>
<?php require '../../layouts/footer.php' ?>