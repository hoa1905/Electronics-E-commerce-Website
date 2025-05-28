<?php require '../../layouts/header.php' ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">
      Danh sách sản phẩm
      <a href="add.php" class="btn btn-primary">Thêm mới</a>
    </h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Sản phẩm</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>STT</th>
              <th>Danh mục</th>
              <th>Tên sản phẩm</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Hình ảnh</th>
              <th>Nội dung</th>
              <th>Ngày tạo</th>
              <th>Ngày cập nhật</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if(isset( $_GET['iddanhmuc'])){
                $id_category = $_GET['iddanhmuc'];

                $sql = "SELECT * FROM products WHERE id_category = $id_category";
                $result = mysqli_query($conn, $sql);

                $stt = 1;
                foreach($result as $row){
                  $sql = "SELECT * From category WHERE id = $id_category";
                  $result = mysqli_query($conn, $sql);
                  $each = mysqli_fetch_array($result);
                  $name_category = $each['name'];

                  $id_product = $row['id'];
                  $name = $row['name'];
                  $price = $row['price'];
                  $number = $row['number'];
                  $image = $row['image'];
                  $content = $row['content'];
                  $created_at = $row['created_at'];
                  $updated_at = $row['updated_at'];
                  echo "
                    <tr>
                      <td>$stt</td>
                      <td>$name_category</td>
                      <td>$name</td>
                      <td>$price</td>
                      <td>$number</td>
                      <td style='text-align: center'><img src='../../../public/frontend/images/$image' height='50px'></td>
                      <td>$content</td>
                      <td>$created_at</td>
                      <td>$updated_at</td>
                      <td><a href='edit.php?idsanpham=$id_product&tendanhmuc=$name_category'><i class='fa-regular fa-pen-to-square'></i></a></td>
                      <td><a href='delete.php?idsanpham=$id_product'><i class='fa-regular fa-trash-can' style='color: red'></i></a></td>
                    </tr>
                  ";
                  $stt++;
                }
              } else{
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);

                $stt = 1;
                foreach($result as $row){
                  $id_category = $row['id_category'];

                  $sql = "SELECT * From category WHERE id = $id_category";
                  $result = mysqli_query($conn, $sql);
                  $each = mysqli_fetch_array($result);
                  $name_category = $each['name'];

                  $id_product = $row['id'];
                  $name = $row['name'];
                  $price = $row['price'];
                  $number = $row['number'];
                  $image = $row['image'];
                  $content = $row['content'];
                  $created_at = $row['created_at'];
                  $updated_at = $row['updated_at'];
                  echo "
                    <tr>
                      <td>$stt</td>
                      <td>$name_category</td>
                      <td>$name</td>
                      <td>$price</td>
                      <td>$number</td>
                      <td style='text-align: center'><img src='../../../public/frontend/images/$image' height='50px'></td>
                      <td>$content</td>
                      <td>$created_at</td>
                      <td>$updated_at</td>
                      <td><a href='edit.php?idsanpham=$id_product&tendanhmuc=$name_category'><i class='fa-regular fa-pen-to-square'></i></a></td>
                      <td><a href='delete.php?idsanpham=$id_product'><i class='fa-regular fa-trash-can' style='color: red'></i></a></td>
                    </tr>
                  ";
                  $stt++;
                }
              }
            ?>
          </tbody>
        </table>
        <nav aria-label="Page navigation example" style="float: right">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</main>
<?php require '../../layouts/footer.php' ?>