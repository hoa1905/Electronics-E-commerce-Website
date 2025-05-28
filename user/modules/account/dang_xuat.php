<?php
  session_start();
  unset($_SESSION['id']);
  unset($_SESSION['name']);
  unset($_SESSION['cart']);

  header('location: /DoAnCoSo2/');