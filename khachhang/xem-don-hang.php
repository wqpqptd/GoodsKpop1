<?php
include_once 'header.php';
?>
<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Chi tiết đơn hàng</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4"></h2>
        <div class="card-body">
 
          <div class="mb-5">

          </div>
            <table class=" table table-striped table-hover">
                <thead>
                    <tr>
                        <th><span class="text-small text-uppercase">Mã</span></th>
                        <th> <span class="text-small text-uppercase">Sản phẩm</span></th>
                        <th> <span class="text-small text-uppercase">Đơn giá</span></th>
                        <th> <span class="text-small text-uppercase ">Số lượng</span></th>
                        <th> <span class="text-small text-uppercase">Thành tiền</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $iddh = $_GET['iddh'];
                    include('connect.php');
                    $sql_hh = "SELECT * from ChiTietDatHang inner join HangHoa 
                               on ChiTietDatHang.MSHH=HangHoa.MSHH where ChiTietDatHang.SoDonDH='$iddh' ";
                    $ds_hh = $conn->query($sql_hh);
                    while ($row = $ds_hh->fetch_assoc()) {
                    ?>
                        <tr>
                            <th scope="row">
                                <?php echo $row["MSHH"] ?>
                            </th>
                            <td>
                                <a class="text-decoration-none text-dark" href="chi-tiet-hh.php?id=<?php echo $row["MSHH"] ?>"><?php echo $row["TenHH"] ?></a>
                            </td>
                            <td>
                                <?php echo $row["GiaDatHang"] ?>
                            </td>
                            <td>
                                <?php echo $row["SoLuong"] ?>
                            </td>
                            <td>
                                <?php echo $row["GiaDatHang"] * $row["SoLuong"] ?>
                            </td>
                        </tr>
                    <?php
                        $total += $row["GiaDatHang"] * $row["SoLuong"];
                    }

                    ?>
                </tbody>
            </table>
        </div>
 
    </section>
</div>

<?php
include_once 'footer.php';
?>