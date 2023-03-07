<?php

include_once('header.php');

?>

<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center ">
                <div class="col-lg-6">
                    <?php
                    $maloaihang;
                    include('connect.php');
                    if (isset($_GET['id']))
                        $maloaihang = $_GET['id'];
                    else
                        $maloaihang = 0;
                    if ($maloaihang == 0)
                        echo '<h1 class="h2 text-uppercase mb-0">Tất cả sản phẩm</h1>';
                    else {
                        $sql_tenloaihang = "SELECT TenLoaiHang from loaihanghoa where MaLoaiHang= $maloaihang";
                        $ds_tlh = $conn->query($sql_tenloaihang);
                        while ($row = $ds_tlh->fetch_assoc()) {
                            echo '<h1 class="h2 text-uppercase mb-0">' . $row["TenLoaiHang"] . '</h1>';
                        }
                    }
                    $conn->close();
                    ?>

                </div>
            </div>
        </div>
    </section>
    <!--  phan trang -->
    <?php
    include('connect.php');
    $id=$_GET['id'];
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $rowperpage = 8 ; 
    $perrow = $page * $rowperpage - $rowperpage;

    $totalrow = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hanghoa_view where MaLoaiHang=$id"));
    $totalpage = ceil($totalrow / $rowperpage); 
    $listPage = "";
    for ($i = 1; $i <= $totalpage; $i++) {
        if ($page == $i) {
            if ($listPage .= '<li class="page-item active"><a class="page-link" href="mua-hang.php?id='.$id.'&page=' . $i . '">' . $i . '</a></li>');
        } else {
            $listPage .= '<li class="page-item"><a class="page-link" href="mua-hang.php?id='.$id.'&page=' . $i . '">' . $i . '</a></li>';
        }
    }
    ?>
<!-- list-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
        <ul class="pagination justify-content-end">
                <?php
                echo $listPage;
                ?>
            </ul>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                include 'connect.php';
                $sql = "SELECT * FROM hanghoa_view  where MaLoaiHang= $maloaihang ORDER BY MSHH LIMIT  $perrow,$rowperpage";
                $query = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- hinh anh san pham-->
                            <img class="card-img-top" src="<?php echo "../quanly/".$row['TenHinh'];?>" alt="..." />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- ten san pham-->
                                    <h5 class="fw-bolder"><?php echo $row['TenHH']; ?></h5>
                                    <!-- gia tien-->
                                    <?php echo $row['Gia']; ?> VND
                                </div>
                            </div>
                            <!-- chi tiet -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">

                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="chi-tiet-hh.php?id=<?php echo $row['MSHH']; ?>">Xem chi tiết</a></div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <ul class="pagination justify-content-end">
                <?php
                echo $listPage;
                ?>
            </ul>
        </div>

    </section>
</div>

<?php include_once('footer.php'); ?>