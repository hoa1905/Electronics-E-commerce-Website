<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
  <title>website bán hàng</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/DoAnCoSo2/public/frontend/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/DoAnCoSo2/public/frontend/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/DoAnCoSo2/public/frontend/css/slick.css">
  <link rel="stylesheet" type="text/css" href="/DoAnCoSo2/public/frontend/css/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="/DoAnCoSo2/public/frontend/css/style.css">
  <script src="/DoAnCoSo2/public/frontend/js/jquery-3.2.1.min.js"></script>
  <script src="/DoAnCoSo2/public/frontend/js/bootstrap.min.js"></script>
  <script src="/DoAnCoSo2/public/frontend/js/script.js"></script>
</head>
<body>
  <?php 
    if(isset($_GET['tim_kiem'])){
      $tim_kiem = $_GET['tim_kiem'];
      header("location: /DoAnCoSo2/?tim_kiem=$tim_kiem");
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $iddanhmuc = $_POST['iddanhmuc'];
      $idsanpham = $_POST['idsanpham'];
      $name = $_POST['ten_dang_nhap'];
      $password = md5($_POST['mat_khau']);

      $conn = mysqli_connect('localhost', 'root', '', 'doancoso2');
      $sql = "SELECT * FROM users WHERE name = '$name' AND password = '$password'";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      if($name == '' &&  $password = ''){
        
      }
      if($count == 1 && isset($iddanhmuc) && isset($idsanpham)){
        $row = mysqli_fetch_array($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("location: /DoAnCoSo2/chi_tiet_san_pham.php?iddanhmuc=$iddanhmuc&idsanpham=$idsanpham");  
        die();
      } if($count == 1){
        $row = mysqli_fetch_array($result);
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header('location: /DoAnCoSo2/index.php');  
      } else{
        $error_message = 'Sai tên đăng nhập hoặc mật khẩu';
        $_SESSION['error'] = $error_message;
        // echo "<script type='text/javascript'>alert('$message')</script>";
      }
    }
  ?>
  <div id="wrapper">
    <div id="header">
      <div id="header-top">
        <div class="container">
          <div class="row clearfix">
            <div class="col-md-6" style="float: right">
              <nav id="header-nav-top">
                <ul class="list-inline pull-right" id="headermenu">
                  <li>
                    <a href="dang_ky.php" style="font-size: 13px; border-right: 1px solid white"><i class="fa fa-user-plus" aria-hidden="true"></i> Đăng ký</a>
                  </li>
                  <li>
                    <a href="" style="font-size: 13px"><i class="fa fa-unlock"></i> Đăng nhập</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container" >
        <div class="row" id="header-main">
          <div class="col-md-2" id="header-left">
            <a href="/DoAnCoSo2/"><i class="fa fa-shopping-basket"></i><span style="color: white; font-size: 30px">SHOP</span></a>
          </div>
          <div class="col-md-8">
            <form class="form-inline">
              <div class="form-group">
                <input type="search" name="tim_kiem" placeholder="Tìm kiếm" class="form-control" style="width: 90%">
                <button type="submit" class="btn btn-default"><i class="fa fa-search" style="color: white"></i></button>
              </div>
            </form>
          </div>
          <div class="col-md-2" id="header-right">
          <a href="" style="font-size: 15px; color: white"><i class="fa fa-cart-plus" aria-hidden="true"></i> Giỏ hàng</a>
          </div>
        </div>
      </div>
      <div id="menunav">
        <div class="container">
          <nav>
            <div class="home pull-left">
              <ul id="menu-main">
                <li>
                  <a href="../../../index.php">TRANG CHỦ</a>
                </li>
                <li>
                  <a href="">GIỚI THIỆU</a>
                </li>
                <li>
                  <a href="">TIN TỨC</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <div id="maincontent">
      <div class="container" style="width: 50%">
        <div class="col-md-9 bor" style="width: 100%; padding: 15px">
          <div class="panel panel-primary" style="margin-bottom: 0px; border-color: #ee4d2c">
            <div class="panel-heading" style="font-size: 17px; background-color: #ee4d2c; border-color: #ee4d2c">Đăng nhập</div>
            <div class="panel-body">
              <form id = "form" class="form-horizontal" action="dang_nhap.php" method="POST">
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST'){ ?>
                  <div class="alert alert-danger d-flex align-items-center" role="alert" style="margin-left: 50px; margin-right: 50px">
                    <?php echo $_SESSION['error'] ?>
                  </div>
                <?php } ?>

                <div class="form-group" style="text-align: center">
                  <label class="col-sm-3 control-label" style="font-size: 13px">Tên đăng nhập <span style="color: red">*</span></label>
                  <div class="col-sm-7" style="display: inline-block">
                    <input id = "ten_dang_nhap" type="text" class="form-control" placeholder="Tên đăng nhập" name="ten_dang_nhap"  value="<?php if(isset($_POST['ten_dang_nhap'])) echo $_POST['ten_dang_nhap'] ?>" style="font-size: 13px">
                  </div>
                  <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      if($_POST['ten_dang_nhap'] == '')
                        echo "<span class='col-sm-7'>Vui lòng điền vào mục này</span>";
                    }
                  ?>
                </div>
                <div class="form-group" style="text-align: center">
                  <label class="col-sm-3 control-label" style="font-size: 13px">Mật khẩu <span style="color: red">*</span></label>
                  <div class="col-sm-7" style="display: inline-block">
                    <input id = "mat_khau" type="password" class="form-control" placeholder="********" name="mat_khau" value="<?php if(isset($_POST['ten_dang_nhap'])) echo $_POST['mat_khau'] ?>" style="font-size: 13px">
                  </div>
                  <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      if($_POST['mat_khau'] == '')
                        echo "<span class='col-sm-7'>Vui lòng điền vào mục này</span>";
                    }
                  ?>
                </div>
                <?php
                  if(isset($_GET['iddanhmuc']) && isset($_GET['idsanpham'])){
                    $iddanhmuc = $_GET['iddanhmuc'];
                    $idsanpham = $_GET['idsanpham'];
                    echo"
                      <input type='hidden' name='iddanhmuc' value='$iddanhmuc'>
                      <input type='hidden' name='idsanpham' value='$idsanpham'>
                    ";
                  }
                ?>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button id="btn_dang_nhap" type="submit" class="btn btn-primary" style="font-size: 13px; margin-left: 11%; background-color: #ee4d2c; border-color: #ee4d2c">Đăng nhập</button>
                  </div>
                </div>
                
              </form>
            </div>
          </div>
          </div>
      </div>
      <div class="container-pluid" style="margin-top: 70px; border-top: 10px solid #444">
        <section id="footer-button" style="background-color: #fff">
          <div class="container-pluid">
            <div class="container">
              <div class="col-md-3" id="ft-about">            
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco </p>
              </div>
              <div class="col-md-3 box-footer" >
                <h3 class="tittle-footer">my accout</h3>
                  <ul>
                    <li>
                      <i class="fa fa-angle-double-right"></i>
                      <a href=""><i></i> Giới thiệu</a>
                    </li>
                    <li>
                      <i class="fa fa-angle-double-right"></i>
                      <a href=""><i></i> Liên hệ </a>
                    </li>
                    <li>
                      <i class="fa fa-angle-double-right"></i>
                      <a href=""><i></i>  Contact </a>
                    </li>
                    <li>
                      <i class="fa fa-angle-double-right"></i>
                      <a href=""><i></i> My Account</a>
                    </li>
                    <li>
                      <i class="fa fa-angle-double-right"></i>
                      <a href=""><i></i> Giới thiệu</a>
                    </li>
                  </ul>
              </div>
              <div class="col-md-3 box-footer">
                  <h3 class="tittle-footer">my accout</h3>
                <ul>
                  <li>
                    <i class="fa fa-angle-double-right"></i>
                    <a href=""><i></i> Giới thiệu</a>
                  </li>
                  <li>
                    <i class="fa fa-angle-double-right"></i>
                    <a href=""><i></i> Liên hệ </a>
                  </li>
                  <li>
                    <i class="fa fa-angle-double-right"></i>
                    <a href=""><i></i>  Contact </a>
                  </li>
                  <li>
                    <i class="fa fa-angle-double-right"></i>
                    <a href=""><i></i> My Account</a>
                  </li>
                  <li>
                    <i class="fa fa-angle-double-right"></i>
                    <a href=""><i></i> Giới thiệu</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-3" id="footer-support">
                <h3 class="tittle-footer"> Liên hệ</h3>
                  <ul>
                    <li>   
                      <p><i class="fa fa-home" style="font-size: 16px;padding-right: 5px;"></i> 470 Trần Đại Nghĩa, Phường Hòa Quý, Quận Ngũ Hành Sơn, TP. Đà Nẵng </p>
                      <p><i class="sp-ic fa fa-mobile" style="font-size: 22px;padding-right: 5px;"></i> 0123 456 789</p>
                      <p><i class="sp-ic fa fa-envelope" style="font-size: 13px;padding-right: 5px;"></i> support@gmail.com</p>
                    </li>
                  </ul>
              </div>
            </div>
          </div>
        </section>
        <section id="ft-bottom" style="background-color: #f1f1f1">
          <p class="text-center">Copyright &#169 2022 - Website bán hàng</p>
        </section>
      </div>
    </div>      
  </div>
  <script  src="/DoAnCoSo2/public/frontend/js/slick.min.js"></script>
</body>
</html>
<script type="text/javascript">
    $(function(){
      $hidenitem = $(".hidenitem");
      $itemproduct = $(".item-product");
      $itemproduct.hover(function(){
        $(this).children(".hidenitem").show(100);
      },function(){
          $hidenitem.hide(500);
      })
    })
</script>