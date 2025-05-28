<?php
  $iddanhmuc = $_GET['iddanhmuc'];
  $conn = mysqli_connect('localhost', 'root', '', 'doancoso2');
  $sql = "DELETE FROM category WHERE id = $iddanhmuc";
  $kq = mysqli_query($conn, $sql);
  
  header("location: /DoAnCoSo2/admin/modules/category");