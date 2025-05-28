<?php require '../../layouts/header.php' ?>
<div class="col-md-9 bor">
  <section class="box-main1">
    <h3 class="title-main"><a href="">Chi tiết đơn mua</a> </h3>
    <table class="table table-hover" style="margin-bottom: unset; text-align: center">
      <thead>
        <tr>
          <td>STT</td>
          <td>Ảnh</td>
          <td>Tên sản phẩm</td>
          <td>Đơn giá</td>
          <td>Số lượng</td>
        </tr>
      </thead>
      <body>
        <?php
          $order_id = $_GET['order_id'];
          $get_order_product_by_order_id_sql = "SELECT * FROM order_product WHERE order_id = $order_id";
          $get_order_product_by_order_id_sql_result = mysqli_query($conn, $get_order_product_by_order_id_sql);
        ?>
        <?php
          $stt = 0;
          while($row = mysqli_fetch_array($get_order_product_by_order_id_sql_result)){
            $get_product_id = $row['product_id'];
            $quantity = $row['quantity'];
            $get_product_by_id_sql = "SELECT * FROM products WHERE id = $get_product_id";
            $get_product_by_id_sql_result = mysqli_query($conn, $get_product_by_id_sql);

            while($row = mysqli_fetch_array($get_product_by_id_sql_result)){
              $stt++;
              $image = $row['image'];
              echo '<tr>';
              echo '<td>' . $stt . '</td>';
              echo "<td><img src='../../../public/frontend/images/${image}' height='50px'></td>";
              echo '<td>' . $row['name'] . '</td>';
              echo '<td>' . $row['price'] . '</td>';
              echo '<td>' . $quantity . '</td>';
              echo '</tr>';
            }
          }
        ?>
      </body>
    </table>
    <div class="showitem" style="text-align: center"></div>
  </section>
<?php require '../../layouts/footer.php' ?>