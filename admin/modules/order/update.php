<?php
  $id = $_GET['id'];
  $status = $_GET['status'];

  $conn = mysqli_connect('localhost', 'root', '', 'doancoso2');
  $sql = "UPDATE orders SET status = $status WHERE id = $id";
  mysqli_query($conn, $sql);

  header('location: ./index.php');