<?php
include_once 'header.php';
?>

<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Lịch sử mua hàng</h1>
                </div>
            </div>
        </div>
    </section>
    <section >
    <h2 class="h5 text-uppercase mb-4">Thông tin </h2>
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
    </section>

    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Đơn hàng</h2>

        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Ngày đặt hàng</th>
                        <th>Ngày giao hàng</th>
                        <th>Trạng thái</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idkh = $_SESSION['makh'];
                    include('connect.php');
                    $sql = "SELECT * FROM donhang_view WHERE MSKH=$idkh";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>" . $row['SoDonDH'] . "</td>
                            <td>" . $row['NgayDH'] . "</td>
                            <td>" . $row['NgayGH'] . "</td>
                            <td>" . $row['TenTrangThai'] . "</td>
                            <td>
                            <a href='xem-don-hang.php?iddh=" . $row['SoDonDH'] . "&idkh=" . $row['MSKH'] . " '> <button type='button' class='btn btn-outline-dark'>Xem</button>
                            </a>   
                    </tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>



    </section>
</div>
<?php
include_once 'footer.php';
?>