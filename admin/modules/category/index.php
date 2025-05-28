<?php require '../../layouts/header.php' ?>
<?php
  $conn = mysqli_connect("localhost", "root", "", "doancoso2");
  $sql = "SELECT * FROM category";
  $kq = mysqli_query($conn, $sql);
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">
      Danh sách danh mục
      <a href="add.php" class="btn btn-primary">Thêm mới</a>
    </h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Danh mục</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên danh mục</th>
              <th>Ngày tạo</th>
              <th>Ngày cập nhật</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php $stt = 1; foreach($kq as $row){ ?>
              <tr>
                <td><?php echo $stt ?></td>
                <td><a href="../product/index.php?iddanhmuc=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['created_at'] ?></td>
                <td><?php echo $row['updated_at'] ?></td>
                <td><?php echo '<a href="edit.php?iddanhmuc=' . $row['id'] . '"><i class="fa-regular fa-pen-to-square"></i></a>' ?></td>
                <td><?php echo '<a href="delete.php?iddanhmuc=' . $row['id'] . '"><i class="fa-regular fa-trash-can" style="color: red"></i></a>' ?></td>
              </tr>
            <?php $stt++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<?php require '../../layouts/footer.php' ?>