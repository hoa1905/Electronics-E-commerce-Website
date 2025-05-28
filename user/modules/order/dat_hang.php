<?php require '../../layouts/header.php' ?>
<style>
  label {
    font-weight: 400;
  }

  form {
    border: 1px solid #ee4d2c;
    padding: 10px;
  }
</style>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name_receiver = $_POST['name_receiver'];
    $phone_receiver = $_POST['phone_receiver'];
    $address_receiver = $_POST['address_receiver'];

    $cart = $_SESSION['cart'];
    $total_price = 0;
    foreach($cart as $each){
      $total_price += $each['so_luong'] * $each['price'];
    }

    $user_id = $_SESSION['id'];
    $status = '0'; //Mới đặt

    $them_thong_tin_vao_bang_orders_sql = "INSERT INTO orders(user_id, name_receiver, phone_receiver, address_receiver, total_price, status) VALUES ('$user_id', '$name_receiver', '$phone_receiver', '$address_receiver', '$total_price', '$status')";
    mysqli_query($conn, $them_thong_tin_vao_bang_orders_sql);

    $lay_order_id_sql = "SELECT max(id) FROM orders WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $lay_order_id_sql);
    $order_id = mysqli_fetch_array($result)['max(id)'];

    foreach($cart as $idsanpham => $each){
      $quantity = $each['so_luong'];
      $sql = "INSERT INTO order_product(order_id, product_id, quantity) VALUES ('$order_id', '$idsanpham', '$quantity')";
      mysqli_query($conn, $sql);

      $sql = "SELECT number FROM products WHERE id = $idsanpham";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_array($result)){
        $current_number = $row['number'];
        $remain_number = $current_number - $quantity;
        $sql = "UPDATE products SET number = $remain_number WHERE id = $idsanpham";
        mysqli_query($conn, $sql);
      }
    }
    require '../../../mail.php';
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $title = "Đặt hàng thành công";
    $content = "Bạn có 1 đơn hàng đã đặt thành công tại Shop";
    sendmail($email, $name, $title, $content);
    mysqli_close($conn);
    unset($_SESSION['cart']);
    echo ("<script>location.href = './don_mua.php'</script>");
  }
?>
<div class="col-md-9 bor">
  <section class="box-main1">
    <h3 class="title-main"><a href="">Thanh toán</a> </h3>
    <table class="table table-hover" style="margin-bottom: unset; text-align: center">
      <thead>
        <tr>
          <td>STT</td>
          <td>Ảnh</td>
          <td>Tên sản phẩm</td>
          <td>Số lượng</td>
          <td>Đơn giá</td>
          <td>Thành tiền</td>
        </tr>
      </thead>
      <body>
        <?php $tong_thanh_toan = 0 ?>
        <?php $stt = 1; foreach($_SESSION['cart'] as $idsanpham => $row){ ?>
          <tr>
            <td><?php echo $stt ?></td>
            <td>
              <a href="/DoAnCoSo2/chi_tiet_san_pham.php?iddanhmuc=<?php echo $row['id_category'] ?>&idsanpham=<?php echo $idsanpham ?>"><img src="../../../public/frontend/images/<?php echo $row['image'] ?>" alt="" height="50px"></a>
            </td>
            <td>
              <a href="chi_tiet_san_pham.php?iddanhmuc=<?php echo $row['id_category'] ?>&idsanpham=<?php echo $idsanpham ?>">
                <p><?php echo $row['name'] ?></p>
              </a>
            </td>
            <td><?php echo $row['so_luong'] ?></td>
            <td><?php echo number_format($row['price']) ?>đ</td>
            <td>
              <span style="color: #ee4d2d">
                <?php
                  $so_tien = $row['price'] * $row['so_luong'];
                  $tong_thanh_toan += $so_tien;
                  echo number_format($so_tien);
                ?>đ
              </span>
            </td>
          </tr>
        <?php $stt++; } ?>
      </body>
    </table>
    <div class="panel-body" style="border-top: 1px solid #ddd">
      <?php
        $iduser = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = $iduser";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
      ?>
      <form class="form-horizontal" action="dat_hang.php" method="POST">
        <label class="" style="font-size: 13px">THÔNG TIN KHÁCH KHÀNG</label>
        <div class="form-group" style="text-align: center">
          <label class="col-sm-3 control-label" style="font-size: 13px">Tên người nhận<span style="color: red">*</span></label>
          <div class="col-sm-8" style="display: inline-block">
            <input type="text" class="form-control" placeholder="Họ và tên" value="<?php echo $row['name'] ?>" name="name_receiver" style="font-size: 13px">
          </div>
        </div>
        <div class="form-group" style="text-align: center">
          <label class="col-sm-3 control-label" style="font-size: 13px">Số điện thoại<span style="color: red">*</span></label>
          <div class="col-sm-8" style="display: inline-block">
            <input type="number" class="form-control" placeholder="Số điện thoại liên hệ" value="<?php echo $row['phone'] ?>" name="phone_receiver" style="font-size: 13px">
          </div>
        </div>
        <div class="form-group" style="text-align: center">
          <label class="col-sm-3 control-label" style="font-size: 13px">Địa chỉ nhận hàng<span style="color: red">*</span></label>
          <div class="col-sm-8" style="display: inline-block">
            <input type="text" class="form-control" placeholder="Địa chỉ nhận hàng" value="<?php echo $row['address'] ?>" name="address_receiver" style="font-size: 13px">
          </div>
        </div>
        <div class="form-group" style="margin-bottom: unset; text-align: center">
          <label class="col-sm-9 control-label" style="font-size: 13px">Tổng thanh toán: <span style="color: #ee4d2d"><?php echo number_format($tong_thanh_toan) ?>đ</span></label>
          <div class="col-sm-2" style="display: inline-block">
            <button type="submit" class="btn btn-primary" style="background-color: #ee4d2c; border-color: #ee4d2c">Đặt hàng</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
<?php require '../../layouts/footer.php' ?>