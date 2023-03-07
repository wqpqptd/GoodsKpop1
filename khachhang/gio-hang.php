<?php
include_once 'header.php';
?>
<div class="container">
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-6">
          <h1 class="h2 text-uppercase mb-0">Giỏ hàng</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <h2 class="h5 text-uppercase mb-4">Giỏ hàng</h2>
    <div class="row">
      <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
        <!-- CART TABLE-->
        <div class="table-responsive mb-4">
          <table class=" table table-striped table-hover">
            <thead>
              <tr>
                <th> <strong class="text-small text-uppercase">Sản phẩm</strong></th>
                <th> <strong class="text-small text-uppercase">Giá</strong></th>
                <th> <strong class="text-small text-uppercase ">Số lượng</strong></th>
                <th> <strong class="text-small text-uppercase">Thành tiền</strong></th>
                <th> </th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              foreach ($cart as $key => $value) {

              ?>
                <tr class="row-cart">
                  <th class="align-middle">
                    <div class="d-flex media align-items-center"><a href="chi-tiet-hh.php?id=<?php echo $value['pd_id'] ?>"><img src=<?php echo "../quanly/" . $value['pd_img'] ?> alt="Ảnh minh họa" width="70" /></a>
                      <div><strong class="h6"><a class="text-decoration-none text-dark " href="chi-tiet-hh.php?id=<?php echo $value['pd_id'] ?>"><?php echo $value['pd_name'] ?> </a></strong></div>
                    </div>
                  </th>
                  <td class="align-middle">
                    <?php echo $value['pd_price'] ?>
                  </td>
                  <form action="" method="post">
                    <td class="align-middle ">
                      <input name="quantity" class=" form-control form-control-sm " type="text" value="<?php echo $value['pd_quantity'] ?>" />
                    </td>
                    <td class="align-middle">
                      <p class="total-item-cart"><?php echo $value['pd_price'] * $value['pd_quantity'] ?></p>
                    </td>
                    <td class=" align-middle ">
                      <button type="submit" name="update" class="btn btn-secondary "><small>Cập nhật</small></button>
                    </td>
                    <td class=" align-middle ">
                      <button type="submit" name="delete" class="btn btn-secondary">Xóa</button>
                      <input type="number" name="id" value="<?php echo  $value['pd_id'] ?>" hidden>
                    </td>

                  </form>

                </tr>
              <?php
                $total += $value['pd_price'] * $value['pd_quantity'];
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ORDER TOTAL-->
      <div class="col-lg-6 offset-lg-6 col-md-12">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
          <div class="card-body">
            <h5 class="text-uppercase mb-4">Thanh toán</h5>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between mb-4">
                <strong class="text-uppercase small font-weight-bold">Tổng cộng</strong>
                <span class="total-cart"><?php echo $total ?></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- CART NAV-->
    <div class="bg-light px-4 py-3">
      <div class="row align-items-center text-center">
        <div class="col-md-6 col-sm-6 col-6 mb-3 mb-md-0 text-md-left">
          <!-- <a class="btn btn-link p-0 text-dark btn-sm" href="shop.php"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Tiếp tục mua sắm</a> -->
        </div>
        <div class="col-md-6 col-sm-6 col-6 text-md-right">
          <a href="dat-hang.php" > 
            <button type="button" class="btn btn-outline-dark btn-sm" >Mua hàng</button>
        </div>
      </div>
    </div>



  </section>
</div>


<!-- Xử lý cập nhật giỏ hàng-->
<?php
if (isset($_POST["delete"])) {
  $id = $_POST["id"];
  unset($_SESSION['cart'][$id]);
  echo "<meta http-equiv='refresh' content='0'>";
}


if (isset($_POST["update"])) {
  $quantity = (int)$_POST["quantity"];
  $id = $_POST["id"];
  $stored = $_SESSION['cart'][$id]['pd_stored'];
  $name = $_SESSION['cart'][$id]['pd_name'];
  if ($quantity <= 0 || $quantity == '') {
    $_SESSION['cart'][$id]['pd_quantity'] = 1;
  } else {
    if ($quantity > $stored) {
      $_SESSION['cart'][$id]['pd_quantity'] = $quantity;
      echo '<div class="row align-items-center pb-5">
                    <div class="col-md-12 col-sm-12 text-md-right">
                      <span class="text-danger" > Số lượng hàng' . $name . 'hiện có là' . $stored . ' </span>
                    </div>
                  </div>';
    } else {
      $_SESSION['cart'][$id]['pd_quantity'] = $quantity;
    }
  }
  echo "<meta http-equiv='refresh' content='0'>";
}

?>

<?php
include_once('footer.php')
?>