<?php
include_once 'header.php';

?>
<div class="container">
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-12">
          <h1 class="h2 text-uppercase mb-0 text-center">ĐĂNG NHẬP</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <!-- BILLING ADDRESS-->
    <div class="row">
      <div class="col-lg-4 m-auto">
        <form method="POST">
          <div class="form-floating mb-3">
            <input class="form-control" name="inputSDT" type="text">
            <label for="inputSDT">Số điện thoại</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" name="inputMk" type="password">
            <label for="inputPassword">Mật khẩu</label>
          </div>

          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <button type="submit" class="btn btn-dark" name="submit">Đăng nhập</button>
            <a href="dang-ky.php" class="btn btn-outline-dark">Đăng ký</a>
            
          </div>

        </form>

      </div>
      <?php
      ob_start();
      session_start();
      include 'connect.php';
      if (isset($_POST["submit"])) {
        $sdt = $_POST["inputSDT"];
        $mk = $_POST["inputMk"];
        if (isset($sdt) && isset($mk)) {
          $sql = "SELECT * FROM khachhang where SoDienThoai='$sdt' AND MatKhau='$mk'";
          $query = mysqli_query($conn, $sql);
          $row = mysqli_num_rows($query);
          $row1 = $query->fetch_assoc();
          echo $sdt, $mk;
          if ($row > 0) {
            $_SESSION["SDTkh"] = $sdt;
            $_SESSION["MKkh"] = $mk;
            $_SESSION['makh'] = $row1['MSKH'];
            header('location: index.php');
          } else {
            echo '<center class="alert alert-danger"> Nhập sai tài khoản hoặc mật khẩu  </center>';
          }
        }
      }
      ?>
    </div>
  </section>
</div>
<?php include_once('footer.php') ?>