<?php
include('connect.php');
$sqltt = "SELECT * FROM trangthaidh";
$querytt = mysqli_query($conn, $sqltt);
?>

<!-- Header -->
<div class="header  pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0">Xác nhận đơn hàng</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('connect.php');
if (isset($_GET['iddh'])) {
    $iddh = $_GET['iddh'];
    $idkh = $_GET['idkh'];
    $sql_dh = "SELECT * from donhang_view where SoDonDH = '$iddh' ";
    $sql_kh = "SELECT * FROM khachhang_view WHERE MSKH='$idkh'";
    $querykh = mysqli_query($conn, $sql_kh);
    $rowkh = mysqli_fetch_array($querykh);
    $querydh = mysqli_query($conn, $sql_dh);
    $rowdh = mysqli_fetch_array($querydh);
    $ds = $conn->query($sql_dh);
    if ($ds) {
        foreach ($ds as $row) {

?>
            <!-- Page content -->
            <div class="container-fluid mt--6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!--Thong tin san pham-->
                        <div class="col-lg-12 col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-7">
                                            <h5 class="mb-0">Thông tin đơn hàng</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="pl-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="id">Mã đơn hàng</label>
                                                    <span name="id" class="form-control"><?php echo $row['SoDonDH'] ?> </span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="tenhang">Ngày đặt hàng</label>
                                                    <span name="ngaydh" class="form-control"><?php echo $row['NgayDH'] ?> </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="tenkh">Tên người nhận</label>
                                                    <span name="tenkh" class="form-control"><?php echo $rowkh['HoTenKH'] ?> </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="sdt">Số điện thoại</label>
                                                    <span name="sdt" class="form-control "><?php echo $rowkh['SoDienThoai'] ?> </span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="diachi">Địa chỉ</label>
                                                    <span name="diachi" class="form-control"><?php echo $rowkh['DiaChi'] ?> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4" />
                                    <!-- Description -->
                                    <div class="pl-lg-4 mb-4">
                                        <!-- CART TABLE-->
                                        <div class="table-responsive mb-4">
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
                                                                <a class="text-decoration-none " href="index.php?page_layout=chinh-sua-hang-hoa&id=<?php echo $row["MSHH"] ?>"><?php echo $row["TenHH"] ?></a>
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
                                    </div>

                                    <div class="row  bg-light">
                                        <div class="col-3 mb-4 text-left">
                                            <div class="form-group">
                                                <label class="form-control-label text-uppercase" for="trangthai"> <strong>Trạng thái</strong> </label>
                                                <span class="text-danger" data-toggle="tooltip" data-placement="left" title="Thay đổi trạng thái">(*)</span>
                                                <select name="trangthai" class="form-control">
                                                    <?php
                                                    while ($rowtt = mysqli_fetch_array($querytt)) {
                                                    ?>
                                                        <option <?php
                                                                if ($rowdh['TrangThaiDH'] == $rowtt['TrangThaiDH']) {
                                                                    echo 'selected ="selected"';
                                                                }

                                                                ?> value="<?php echo $rowtt['TrangThaiDH']; ?>"> <?php echo $rowtt['TenTrangThai']; ?>

                                                        </option>
                                                                
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3 mb-4 text-left">
                                        <label class="form-control-label text-uppercase" for="trangthai"> <strong>Ngày giao hàng  </strong> </label>
                                        <input class="form-control" type="date" name="ngaygh" value="" placeholder="VD: 2021-10-01"> 
                                        </div>
                                        <div class="col-6 mb-4 ">
                                        <label class="form-control-label text-uppercase " > <strong> <p>Tổng tiền</p> </strong> </label><br>
                                            <span class="text-dark"><?php echo $total ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 ">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Xác nhận">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    <?php
        }
    }
}
    ?>
            </div>

            <?php
            include 'connect.php';
            $id = $_GET['id'];
            if (isset($_POST["submit"])) {
                $idtt = $_POST["trangthai"];
                $msnv = $_SESSION['msnv'];
                $ngaygh= $_POST['ngaygh'];
                $sql = "UPDATE dathang SET TrangThaiDH='$idtt', MSNV='$msnv', NgayGH='$ngaygh' WHERE SoDonDH=$iddh";
                $sql1="UPDATE dathang SET TrangThaiDH='$idtt', MSNV='$msnv' WHERE SoDonDH='$iddh'";
                if($idtt !=3)
                {
                    if ($conn->query($sql1)) {
                        echo '<div class="alert  alert-success alert-dismissible" role="alert">
                                     <strong>Thao tác thành công</strong> 
                                     <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                 <strong>Thao tác thất bại a!!</strong> 
                                 <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>';
                    }
                }
                else 
                {
                    if ($conn->query($sql)) {
                        echo '<div class="alert  alert-success alert-dismissible" role="alert">
                                     <strong>Thao tác thành công</strong> 
                                     <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                 <strong>Thao tác thất bại !!</strong> 
                                 <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>';
                    }
                }


            }

            ?>
