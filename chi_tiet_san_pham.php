<?php require './user/layouts/header.php' ?>
<?php
  //Lấy sản phẩm theo id sản phẩm
  $iddanhmuc = $_GET['iddanhmuc'];
  $idsanpham = $_GET['idsanpham'];
  $conn = mysqli_connect("localhost", "root", "", "doancoso2");
  $lay_san_pham_theo_id_san_pham_sql = "SELECT * FROM products WHERE id = $idsanpham";
  $lay_san_pham_theo_id_san_pham_sql_result = mysqli_query($conn, $lay_san_pham_theo_id_san_pham_sql);
  $lay_san_pham_theo_id_san_pham_row = mysqli_fetch_array($lay_san_pham_theo_id_san_pham_sql_result);
  //Lấy sản phẩm theo id danh mục
  $id_category = $_GET['iddanhmuc'];
  $lay_san_pham_theo_id_danhmuc_sql = "SELECT * FROM products WHERE id_category = $id_category ORDER BY RAND() LIMIT 4";
  $lay_san_pham_theo_id_danhmuc_sql_result = mysqli_query($conn, $lay_san_pham_theo_id_danhmuc_sql);
?>
<div class="col-md-9 bor" style="padding-bottom: 15px">
  <section class="box-main1">
    <div class="col-md-6 text-center">
      <img src="./public/frontend/images/<?php echo $lay_san_pham_theo_id_san_pham_row['image'] ?>" class="img-responsive bor" id="imgmain" width="100%" height="370">
    </div>
    <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
      <ul id="right">
        <li>
          <h3>Tên: <?php echo $lay_san_pham_theo_id_san_pham_row['name'] ?></h3>
        </li>
        <li>
          <p>Giá: <b><?php echo number_format($lay_san_pham_theo_id_san_pham_row['price']) ?>đ</b></p>
        </li>
        <li>
          <p>Số lượng: <b><?php echo $lay_san_pham_theo_id_san_pham_row['number'] ?></b></p>
        </li>

        <?php if(isset($_SESSION['name'])){ ?>
          <?php if($lay_san_pham_theo_id_san_pham_row['number'] == 0){ ?>
            <li>
              <a id="btn_add_cart" href="" class="btn btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i>Thêm vào giỏ hàng</a>
            </li>
            <li id="alert_cart" class="alert alert-success" role="alert" style="margin-left: 8px; margin-bottom: 0px; display: none">
              Đã hết hàng
            </li>
          <?php } else{ ?>
            <li>
              <a id="btn_add_cart" href="./user/modules/cart/them_vao_gio_hang.php?iddanhmuc=<?php echo $iddanhmuc ?>&idsanpham=<?php echo $idsanpham ?>" class="btn btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ hàng</a>
            </li>
            <li id="alert_cart" class="alert alert-success" role="alert" style="margin-left: 8px; margin-bottom: 0px; display: none">
              Sản phẩm đã được thêm vào giỏ hàng
            </li>
          <?php } ?>
        <?php } else{ ?>
          <li>
            <a href="./user/modules/account/dang_nhap.php?iddanhmuc=<?php echo $iddanhmuc ?>&idsanpham=<?php echo $idsanpham ?>" class="btn btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i>Thêm vào giỏ hàng</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </section>
  <div class="col-md-12" id="tabdetail">
    <div class="row">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm</a></li>
        <li><a data-toggle="tab" href="#menu1">Nội dung bình luận</a></li>
      </ul>
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>Nội dung</h3>
          <p><?php echo $lay_san_pham_theo_id_san_pham_row['content'] ?></p>
        </div>
        <div id="menu1" class="tab-pane fade">
         <?php require './danh_gia.php'?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-9 bor" style="margin-top: 20px; padding-top: 10px; padding-bottom: 15px">
  <h4>CÁC SẢN PHẨM KHÁC</h4>
  <div class="showitem">
    <?php foreach($lay_san_pham_theo_id_danhmuc_sql_result as $row){ ?>
      <div class="col-md-3 item-product bor">
        <a href="chi_tiet_san_pham.php?iddanhmuc=<?php echo $id_category ?>&idsanpham=<?php echo $row['id'] ?>">
          <img src="./public/frontend/images/<?php echo $row['image'] ?>" class="" width="100%" height="180px">
        </a>
        <div class="info-item">
          <a href="chi_tiet_san_pham.php?iddanhmuc=<?php echo $id_category ?>&idsanpham=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
          <p><b><?php echo number_format($row['price']) ?>đ</b></p>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<?php require './user/layouts/footer.php' ?>