<?php
include_once 'header.php';
session_start();
?>
<div class="container">
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-6">
          <h1 class="h2 text-uppercase mb-0">Xác nhận thông tin đặt hàng</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <h2 class="h5 text-uppercase mb-4">Thông tin người nhận</h2>
    <div class="row">
      <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
        <!-- CART TABLE-->
        <div class="table-responsive mb-4">
          <table class=" table table-striped ">
            <thead>
              <tr>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ nhận hàng </th>
              </tr>
            </thead>
            <tbody>
              <?php
              include('connect.php');
              $makh = $_SESSION['makh'];
              $sql = "SELECT * FROM khachhang_view WHERE MSKH=$makh";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                echo "
                        <tr>
                            <td>" . $row['HoTenKH'] . "</td>
                            <td>" . $row['SoDienThoai'] . "</td>
                            <td>" . $row['DiaChi'] . " </td>                 
                       </td>
                    </tr>";
              }
              $conn->close();
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    <h2 class="h5 text-uppercase mb-4">Đơn hàng</h2>
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
                      <?php echo $value['pd_quantity'] ?>
                    </td>
                    <td class="align-middle">
                      <p class="total-item-cart"><?php echo $value['pd_price'] * $value['pd_quantity'] ?></p>
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
          <form method="post">
            <button type="submit" class="btn btn-outline-dark btn-lg " name="dathang">Đặt hàng</button>

          </form>

          <?php
          include 'connect.php';
          if (isset($_POST['dathang'])) {
            if (isset($_SESSION['cart'])) {
                $date = date("Y-m-d");
            
              $sql_dathang = "INSERT into dathang (MSKH,NgayDH,TrangThaiDH) values( '$makh','$date',1)";
              if ($conn->query($sql_dathang)) {
                $last_id_dathang = $conn->insert_id;
              }
              foreach ($cart as $key => $value) {
                $id = $value['pd_id'];
                $soluong = $value['pd_quantity'];
                $gia = $value['pd_price'];
               $sql_ctdh = "INSERT into chitietdathang (SoDonDH,MSHH,SoLuong,GiaDatHang) values('$last_id_dathang','$id','$soluong','$gia')";
               $sql_ctdh = "call sp_dathang('$last_id_dathang','$id','$soluong','$gia')";
               if (!$conn->query($sql_ctdh) ) {
                                          echo '<div class="alert alert-danger alert-dismissible ">
              <strong>Đã xảy ra lỗi '. $id.' !!</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" >
              </button>
          </div>';
                }               
              }

            }
            unset($_SESSION['cart']);
            echo '<div class="alert  alert-success alert-dismissible">
            <strong>Đặt hàng thành công</strong> 
            <button type="button" class="btn-close"data-bs-dismiss="alert">
            </button>
        </div>';
          }

          ?>
        </div>
      </div>
    </div>



  </section>
</div>

<?php
include_once 'footer.php';

?>