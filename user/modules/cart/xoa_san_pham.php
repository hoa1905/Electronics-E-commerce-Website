<?php
  session_start();
  $idsanpham = $_GET['idsanpham'];

  unset($_SESSION['cart'][$idsanpham]);

  header('location: gio_hang.php');
