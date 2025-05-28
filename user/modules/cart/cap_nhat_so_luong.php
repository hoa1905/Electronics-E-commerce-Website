<?php
  session_start();
  $idsanpham = $_GET['idsanpham'];
  $type = $_GET['type'];

  if($type == 'tru'){
    if($_SESSION['cart'][$idsanpham]['so_luong'] > 1){
      $_SESSION['cart'][$idsanpham]['so_luong']--;
    } else{
      unset($_SESSION['cart'][$idsanpham]);
    }
  } else{
    $_SESSION['cart'][$idsanpham]['so_luong']++;
  }

  header('location: ./gio_hang.php');