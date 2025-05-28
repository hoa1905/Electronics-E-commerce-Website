<?php
  session_start();
  // unset($_SESSION['cart']);
  $iddanhmuc = $_GET['iddanhmuc'];
  $idsanpham = $_GET['idsanpham'];

  if(empty($_SESSION['cart'][$idsanpham])){
    $conn = mysqli_connect('localhost', 'root', '', 'doancoso2');
    $sql = "SELECT * FROM products WHERE id = '$idsanpham'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $_SESSION['cart'][$idsanpham]['name'] = $row['name'];
    $_SESSION['cart'][$idsanpham]['image'] = $row['image'];    
    $_SESSION['cart'][$idsanpham]['price'] = $row['price'];    
    $_SESSION['cart'][$idsanpham]['id_category'] = $row['id_category'];    
    $_SESSION['cart'][$idsanpham]['so_luong'] = 1;
  } else{
    $_SESSION['cart'][$idsanpham]['so_luong']++;
  }
  // echo json_encode($_SESSION['cart']);
  header("location: ../../../chi_tiet_san_pham.php?iddanhmuc=$iddanhmuc&idsanpham=$idsanpham");  