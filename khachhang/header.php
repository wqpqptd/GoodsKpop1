<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<head>
    <title>Trang chủ </title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php"><img src="../quanly/img/banner/logo.png" alt="logo" width="200px" ></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 ">
                <!-- Xử lý show danh sách loại hàng -->
                <?php
                include('connect.php');
                $sql_loaihang = "SELECT * from loaihanghoa";
                $ds_lh = $conn->query($sql_loaihang);
                while ($row = $ds_lh->fetch_assoc()) {
                    echo '<li class="nav-item text-uppercase"><a class="nav-link" href="mua-hang.php?id=' . $row["MaLoaiHang"] . '">'  . $row["TenLoaiHang"] . '</a>';
                }
                $conn->close();
                ?>
            </ul>

            <a href="gio-hang.php">
                <button class="btn btn-outline-dark ">
                    Giỏ hàng
                    <span class="badge bg-dark text-white ms-1 rounded-pill "> <?php
                                                                                $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
                                                                                $count = 0;
                                                                                foreach ($cart as $key => $value) {
                                                                                    $count += $value['pd_quantity'];
                                                                                }
                                                                                echo $count;
                                                                                ?></span>
                </button>
            </a>
                                                                            

                        <!-- Xử lý hiển thị tài khoản hoặc đăng nhập -->
                        <?php
            if (isset($_SESSION['makh'])) {
                echo '        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="lich-su-mua-hang.php">Lịch sử mua hàng</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="dang-xuat.php">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>';
            } else
                echo '<li> <a class="nav-item text-uppercase text-decoration-none text-dark " href="dang-nhap.php"> Đăng nhập</a> </li>' 
            ?>
        </div>
        
    </div>
    
</nav>