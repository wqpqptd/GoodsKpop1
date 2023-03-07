<?php
ob_start();
session_start();
include 'connect.php';
if (isset($_POST["submit"])) {
    $sdt = $_POST["inputSDT"];
    $mk = $_POST["inputMk"];
    if (isset($sdt) && isset($mk)) {
        $sql = "SELECT * FROM nhanvien where SoDienThoai='$sdt' AND MatKhau='$mk'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($query);
        $row1=$query->fetch_assoc();
        if ($row > 0) {
            $_SESSION["SDT"] = $sdt;
            $_SESSION["MK"] = $mk;
            $_SESSION['name']=$row1['HoTenNV'];
            $_SESSION['msnv']=$row1['MSNV'];
            header('location: index.php');
        } else {
            echo '<center class="alert alert-danger"> Nhập sai tài khoản hoặc mật khẩu  </center>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/styles.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-secondary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Đăng nhập</h3>
                            </div>
                            <div class="card-body">
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
                                        <button type="submit" class="btn btn-outline-secondary" name="submit">Đăng nhập</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>



</body>

</html>