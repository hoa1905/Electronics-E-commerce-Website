<?php require '../../layouts/header.php' ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">
      Chi tiết đơn hàng
    </h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="./index.php">Đơn hàng</a></li>
      <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>STT</th>
              <th>Ảnh</th>
              <th>Tên sản phẩm</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $order_id = $_GET['id'];
              $sum = 0;
              $sql = "SELECT * 
                      FROM order_product 
                      JOIN products 
                      ON products.id = order_product.product_id
                      WHERE order_id = $order_id";
              $result = mysqli_query($conn, $sql);
            ?>
            <?php $stt = 1; foreach($result as $each){ ?>
              <tr>
                <td><?php echo $stt ?></td>
                <td><img src="/DoAnCoSo2/public/frontend/images/<?php echo $each['image']?>" height="50px" alt=""></td>
                <td><?php echo $each['name'] ?></td>
                <td><?php echo $each['price'] ?>đ</td>
                <td><?php echo $each['quantity'] ?></td>
                <td>
                  <?php 
                    $result = $each['price'] * $each['quantity'];
                    $sum += $result;
                    echo number_format($result);
                  ?>đ
                </td>
              </tr>
            <?php $stt++; } ?>
            <tr>
              <td colspan="6" style="text-align: center">Tổng tiền đơn này: <span style="color: #ee4d2d"><?php echo number_format($sum) ?>đ<span></td>
            </tr>
          </tbody>
        </table>
        <nav aria-label="Page navigation example" style="float: right">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</main>
<?php require '../../layouts/footer.php' ?>