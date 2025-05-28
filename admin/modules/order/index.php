<?php require '../../layouts/header.php' ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">
      Danh sách đơn hàng
    </h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Đơn hàng</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã đơn hàng</th>
              <th>Thời gian đặt</th>
              <th>Thông tin người đặt</th>
              <th>Thông tin người nhận</th>
              <th>Trạng thái</th>
              <th>Tổng tiền</th>
              <th>Chi tiết đơn hàng</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT orders.*, 
                            users.name, 
                            users.phone, 
                            users.address 
                            FROM orders 
                            JOIN users ON users.id = orders.user_id
                            ORDER BY(created_at) DESC";
              $result = mysqli_query($conn, $sql);
            ?>
            <?php $stt = 1; foreach($result as $each){ ?>
              <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $each['id'] ?></td>
                <td><?php echo $each['created_at'] ?></td>
                <td>
                  <?php echo $each['name'] ?><br>
                  <?php echo $each['phone'] ?><br>
                  <?php echo $each['address'] ?><br>
                </td>
                <td>
                  <?php echo $each['name_receiver'] ?><br>
                  <?php echo $each['phone_receiver'] ?><br>
                  <?php echo $each['address_receiver'] ?><br>
                </td>
                <td>
                  <?php
                    switch($each['status']){
                      case '0':
                        echo "Mới đặt";
                        break;
                      case '1':
                        echo "Đã duyệt";
                        break;
                      case '2':
                        echo "Đã hủy";
                        break;
                    }
                  ?>
                </td>
                <td><?php echo $each['total_price'] ?>đ</td>
                <td>
                  <a href="./order_detail.php?id=<?php echo $each['id']?>"><i class="fa fa-eye"></i> Xem</a>
                </td>
                <td>
                  <?php
                    $id = $each['id'];
                    switch($each['status']){
                      case '0':
                        echo "
                          <a href='./update.php?id=$id&status=1'><i class='fa fa-check-square' aria-hidden='true'></i> Duyệt<a>
                          <br><br>
                          <a href='./update.php?id=$id&status=2'><span style='color: #ee4d2d'><i class='fa fa-ban' aria-hidden='true'></i> Hủy</span></a>
                        ";
                        break;
                      case '1':
                        echo "
                          <a href='./update.php?id=$id&status=2'><span style='color: #ee4d2d'><i class='fa fa-ban' aria-hidden='true'></i> Hủy</span></a>
                        ";
                        break;
                      case '2':
                        echo "
                          <a href='./update.php?id=$id&status=1'><i class='fa fa-check-square' aria-hidden='true'></i> Duyệt</a>
                        ";
                        break;
                    }
                  ?>
                </td>
              </tr>
            <?php $stt++; } ?>
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