<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "doancoso2");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Trang Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="/DoAnCoSo2/public/admin/css/styles.css">
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

</head>
<body>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Xin Chào Admin</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Tìm kiếm" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><?php echo $_SESSION['name'] ?></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#!">Tài khoản của tôi</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="/DoAnCoSo2/admin/dang_xuat.php">Đăng xuất</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <a class="nav-link" href="/DoAnCoSo2/admin/tong_quan.php">
              <div class="sb-nav-link-icon"><i class="fas fa-chart-area me-1"></i></div>
              Theo dõi thống kê doanh thu
            </a>
            <a class="nav-link" href="/DoAnCoSo2/admin/modules/account_user/">
              <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
              Quản lý người dùng
            </a>
            <a class="nav-link" href="/DoAnCoSo2/admin/modules/category/">
              <div class="sb-nav-link-icon"><i class="fa fa-list"></i></div>
              Quản lý danh mục
            </a>
            <a class="nav-link" href="/DoAnCoSo2/admin/modules/product/">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
              Quản lý sản phẩm
            </a>
            <a class="nav-link" href="/DoAnCoSo2/admin/modules/order/">
              <div class="sb-nav-link-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
              Quản lý đơn hàng
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">