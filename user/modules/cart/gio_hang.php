<?php require '../../layouts/header.php' ?>
<div class="col-md-9 bor">
  <section class="box-main1">
    <h3 class="title-main"><a href="">Giỏ hàng</a> </h3>
    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){ ?>
      <table class="table table-hover" style="margin-bottom: unset; text-align: center">
        <thead>
          <tr>
            <td>STT</td>
            <td>Ảnh</td>
            <td>Tên sản phẩm</td>
            <td>Số lượng</td>
            <td>Đơn giá</td>
            <td>Số tiền</td>
            <td>Thao tác</td>
          </tr>
        </thead>

        <body>
          <?php $tong_thanh_toan = 0 ?>
          <?php $stt = 1;
          foreach($_SESSION['cart'] as $idsanpham => $each){ ?>
            <?php
              $sql = "SELECT * FROM products WHERE id = $idsanpham";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
            ?>
              
            <tr>
              <td><?php echo $stt ?></td>
              <td>
                <a href="../../../chi_tiet_san_pham.php?iddanhmuc=<?php echo $each['id_category'] ?>&idsanpham=<?php echo $idsanpham ?>"><img src="../../../public/frontend/images/<?php echo $each['image'] ?>" alt="" height="50px"></a>
              </td>
              <td>
                <a href="../../../chi_tiet_san_pham.php?iddanhmuc=<?php echo $each['id_category'] ?>&idsanpham=<?php echo $idsanpham ?>">
                  <p><?php echo $each['name'] ?></p>
                </a>
              </td>

              <?php if($each['so_luong'] < $row['number']){ ?>
                <td>
                  <a href="./cap_nhat_so_luong.php?idsanpham=<?php echo $idsanpham ?>&type=tru"><input type="text" value="-" style="color: #444"></a>
                  <input type="number" value="<?php echo $each['so_luong'] ?>" style="text-align: center; width: 40px">
                  <a href="./cap_nhat_so_luong.php?idsanpham=<?php echo $idsanpham ?>&type=cong"><input type="text" value="+" style="color: #444"></a>
                </td>
              <?php } else{?>
                <td>
                  <a href="./cap_nhat_so_luong.php?idsanpham=<?php echo $idsanpham ?>&type=tru"><input type="text" value="-" style="color: #444"></a>
                  <input type="number" value="<?php echo $each['so_luong'] ?>" style="text-align: center; width: 40px">
                  <a href=""><input type="text" value="+" style="color: #444"></a>
                </td>
              <?php } ?>
             
              <td><?php echo number_format($each['price']) ?>đ</td>
              <td>
                <span style="color: #ee4d2d">
                  <?php
                    $so_tien = $each['price'] * $each['so_luong'];
                    $tong_thanh_toan += $so_tien;
                    echo number_format($so_tien);
                  ?>đ
                </span>
              </td>
              <td><a href="./xoa_san_pham.php?idsanpham=<?php echo $idsanpham ?>"><span>Xóa</span></a></td>
            </tr>
          <?php $stt++; } ?>
          <tr style="border-top: 1px solid #ddd">
            <td colspan="6" style="text-align: end">Tổng thanh toán: <span style="color: #ee4d2d"><?php echo number_format($tong_thanh_toan) ?>đ</span></td>
            <td>
              <a href="../order/dat_hang.php">
                <button class="btn btn-primary" style="background-color: #ee4d2c; border-color: #ee4d2c">Mua hàng</button>
              </a>
            </td>
          </tr>
        </body>
      </table>
    <?php } else{ ?>
      <div class="showitem" style="text-align: center">
        <h3>Giỏ hàng của bạn còn trống</h3>
      </div>
      <div style="text-align: center; margin-bottom: 20px">
        <a href="/DoAnCoSo2/">
          <button class="btn btn-primary" style="background-color: #ee4d2c; border-color: #ee4d2c">MUA NGAY</button>
        </a>
      </div>
    <?php } ?>
  </section>
<?php require '../../layouts/footer.php' ?>