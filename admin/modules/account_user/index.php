<?php require '../../layouts/header.php' ?>
<?php
  $conn = mysqli_connect("localhost", "root", "", "doancoso2");
  $sql = "SELECT * FROM users";
  $kq = mysqli_query($conn, $sql);
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">
      Danh sách người dùng
    </h1>
    <ol class="breadcrumb mb-4">
    </ol>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Địa chỉ</th>
              <th>Cấp quyền</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php $stt = 1; foreach($kq as $row){ ?>
              <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo '<a href="edit.php?iddanhmuc=' . $row['id'] . '"><i class="fa-regular fa-pen-to-square"></i></a>' ?></td>
                <td><?php echo '<a href="delete.php?id=' . $row['id'] . '"><i class="fa-regular fa-trash-can" style="color: red"></i></a>' ?></td>
              </tr>
            <?php $stt++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<?php require '../../layouts/footer.php' ?>