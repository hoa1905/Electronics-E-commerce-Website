<?php require '../../layouts/header.php' ?>
<div class="col-md-9 bor" style="margin-bottom: 20px">
  <section class="box-main1">
    <h3 class="title-main"><a href="">Đơn mua</a> </h3>
    <?php
      $user_id = $_SESSION['id'];
      $sql = "SELECT * FROM orders WHERE user_id = $user_id";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      if(isset($row['user_id']) == $user_id){
    ?>
      <table class="table table-hover" style="margin-bottom: unset; text-align: center">
        <thead>
          <tr>
            <td>STT</td>
            <td>Tên</td>
            <td>Số điện thoại</td>
            <td>Địa chỉ</td>
            <td>Tổng tiền</td>
            <td>Trạng thái</td>
            <td>Xem chi tiết</td>
          </tr>
        </thead>
        <body>
          <?php
            $user_id = $_SESSION['id'];
            $get_orders_by_user_id_sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC";
            $get_orders_by_user_id_sql_result = mysqli_query($conn, $get_orders_by_user_id_sql);
          ?>
          <?php
            $stt = 0;
            while($row = mysqli_fetch_array($get_orders_by_user_id_sql_result)){
              $stt++;
              echo '<tr>';
              echo '<td>' . $stt . '</td>';
              echo '<td>' . $row['name_receiver'] . '</td>';
              echo '<td>' . $row['phone_receiver'] . '</td>';
              echo '<td>' . $row['address_receiver'] . '</td>';
              echo '<td>' . number_format($row['total_price']) . "đ" . '</td>';
              echo '<td>' . $row['status'] . '</td>';
              echo '<td><a href="./chi_tiet_don_mua.php?order_id=' . $row['id'] . '" style="color: #444">' . "Xem" . '</a></td>';
              echo '</tr>';
            }
          ?>
        </body>
      </table>
    <?php } else{ ?>
      <div class="showitem" style="text-align: center">
        <h3>Bạn chưa có đơn hàng nào</h3>
      </div>
      <div style="text-align: center; margin-bottom: 20px">
        <a href="index.php">
          <button class="btn btn-primary" style="background-color: #ee4d2c; border-color: #ee4d2c">MUA NGAY</button>
        </a>
      </div>
    <?php } ?>
  </section>
<?php require '../../layouts/footer.php' ?>