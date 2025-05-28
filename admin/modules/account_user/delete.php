<?php
  $id = $_GET['id'];
  $conn = mysqli_connect('localhost', 'root', '', 'doancoso2');
  $sql = "DELETE FROM users WHERE id = $id";
  $kq = mysqli_query($conn, $sql);
  
  header("location: /DoAnCoSo2/admin/modules/account_user/");