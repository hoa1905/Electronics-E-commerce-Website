<?php require './user/layouts/header.php' ?>
<?php
  $limit = 8;

  $conn = mysqli_connect("localhost", "root", "", "doancoso2");
  $product_sql = "SELECT * FROM products";
  $product_sql_result = mysqli_query($conn, $product_sql);

  $trang = isset($_GET['trang']) ? $_GET['trang'] : 1;

  $so_hang_hoa_sql = "SELECT count(id) as total FROM products";

  $so_hang_hoa_sql_result = mysqli_query($conn, $so_hang_hoa_sql);
  $row = mysqli_fetch_array($so_hang_hoa_sql_result);

  $tongsosanpham = $row["total"];
  $tongsotrang = ceil($tongsosanpham / $limit);

  $start = ($trang - 1) * $limit;
  $so_hang_hoa_tren_mot_trang_result = mysqli_query($conn, "SELECT * FROM products LIMIT $start, $limit");
?>
<?php
  if(isset($_GET['tim_kiem'])){
    $tim_kiem = $_GET['tim_kiem'];
    $so_hang_hoa_tren_mot_trang_result = mysqli_query($conn, "SELECT * FROM products WHERE name like '%$tim_kiem%' LIMIT $start, $limit");
  }
?>
<div class="col-md-9 bor" style="background-color: #fff">
  <section id="slide" class="text-center">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="./public/frontend/images/slide/banner1.jpg" style="width: 100%" alt="Los Angeles">
        </div>
        <div class="item">
          <img src="./public/frontend/images/slide/banner2.jpg" style="width: 100%" alt="Chicago">
        </div>
        <div class="item">
          <img src="./public/frontend/images/slide/banner1.jpg" style="width: 100%" alt="New York">
        </div>
      </div>
      <a href="#myCarousel" class="left carousel-control" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a href="#myCarousel" class="right carousel-control" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>

  <section class="box-main1">
    <div class="showitem clearfix">
      <?php foreach($so_hang_hoa_tren_mot_trang_result as $row){ ?>
        <div class="col-md-3 item-product bor">
          <a href="chi_tiet_san_pham.php?iddanhmuc=<?php echo $row['id_category'] ?>&idsanpham=<?php echo $row['id'] ?>">
            <img src="./public/frontend/images/<?php echo $row['image'] ?>" class="" width="100%" height="180px">
          </a>
          <div class="info-item">
            <a href="chi_tiet_san_pham.php?iddanhmuc=<?php echo $row['id_category'] ?>&idsanpham=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
            <p><b><?php echo number_format($row['price']) ?>đ</b></p>
          </div>
        </div>
      <?php } ?>
    </div>
    <nav class="text-center">
      <ul class="pagination">
        <?php
          $trang = isset($_GET['trang']) ? $_GET['trang'] : 1;
          for($i = 1; $i <= $tongsotrang; $i++){
            if($trang == $i)
              echo "<li><a href='index.php?trang=${i}' class='active'>${i}</a></li>";
            else
              echo "<li><a href='index.php?trang=${i}'>${i}</a></li>";
          }
        ?>
      </ul>
    </nav>
  </section>
<?php require './user/layouts/footer.php' ?>