<?php
session_start();
if (!isset($_SESSION['SDT'])) {
    header('location:dang-nhap.php');
}
?>

<html>

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

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">COFFEESHOP</a>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="dang-xuat.php">Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php?page_layout=don-hang-moi">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Xác nhận đơn hàng
                        </a>
                        <a class="nav-link" href="index.php?page_layout=lich-su-don-hang">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Lịch sử đơn hàng
                        </a>
                        <a class="nav-link" href="index.php?page_layout=hang-hoa">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Quản lý hàng hóa
                        </a>
                        <a class="nav-link" href="index.php?page_layout=loai-hang">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Quản lý loại hàng
                        </a>
                        <a class="nav-link" href="index.php?page_layout=nhan-vien">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Quản lý nhân viên
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Tài khoản:</div>
                    <?php
                    include 'connect.php';
                    if (isset($_SESSION['SDT'])) {
                        echo $_SESSION['name'];
                    }
                    ?>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <?php
            if (isset($_GET["page_layout"])) {
                switch ($_GET["page_layout"]) {
                    case 'hang-hoa':
                        include_once './hang-hoa.php';
                        break;
                    case 'loai-hang':
                        include_once './loai-hang.php';
                        break;
                    case 'chinhsualoaihang':
                        include_once './chinh-sua-loai-hang.php';
                        break;
                    case 'quan-ly-don-hang':
                        include_once './quan-ly-don-hang.php';
                        break;
                    case 'lich-su-don-hang':
                        include_once './lich-su-don-hang.php';
                        break;
                    case 'nhan-vien':
                        include_once './nhan-vien.php';
                        break;
                    default:
                    case 'them-loai-hang':
                        include_once './them-loai-hang.php';
                        break;
                    case 'them-hang-hoa':
                        include_once './them-hang-hoa.php';
                        break;
                    case 'chinh-sua-hang-hoa':
                        include_once './chinh-sua-hang-hoa.php';
                        break;
                    case 'xac-nhan-don-hang':
                        include_once './xac-nhan-don-hang.php';
                        break;
                    case 'don-hang-moi':
                        include_once './don-hang-moi.php';
                        break;
                    case 'xem-don-hang':
                        include_once './xem-don-hang.php';
                        break; 
                }
            }

            ?>
        </div>
    </div>
    <footer class="py-4 bg-light mt-auto">
<div class="container-fluid px-4">
    <div class="d-flex align-items-center justify-content-between small">
        <div class="text-muted">Copyright &copy; 2022</div>
    </div>
</div>


</footer>

</body>

</html>