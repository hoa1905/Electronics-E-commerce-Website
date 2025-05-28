<?php
  $idsanpham = $_GET['idsanpham'];
  $conn = mysqli_connect('localhost', 'root', '', 'doancoso2');
  $sql = "DELETE FROM products WHERE id = $idsanpham";
  $kq = mysqli_query($conn, $sql);

  header("location: /DoAnCoSo2/admin/modules/product");
