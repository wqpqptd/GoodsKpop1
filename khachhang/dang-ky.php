<?php
include_once 'header.php';

?>
<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-12">
                    <h1 class="h2 text-uppercase mb-0 text-center">ĐĂNG KÝ</h1>
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
                        <input class="form-control" name="tenkh" type="text">
                        <label for="tenkh">Họ tên<span class="text-danger" data-placement="left">(*)</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="tencty" type="text">
                        <label for="tencty">Tên công ty</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="fax" type="text">
                        <label for="fax">Số fax</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="diachi" type="text">
                        <label for="diachi">Địa chỉ <span class="text-danger" data-placement="left" >(*)</span> (số nhà, tên đường, thành phố, tỉnh)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="sdt" type="text">
                        <label for="sdt">Số điện thoại<span class="text-danger" data-placement="left">(*)</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="mk" type="password">
                        <label for="mk">Mật khẩu<span class="text-danger" data-placement="left">(*)</span></label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button type="submit" class="btn btn-dark" name="submit">Xác nhận</button>

                    </div>

                </form>

            </div>
            <?php
            include 'connect.php';
            if (isset($_POST["submit"])) {
                $tenkh = $_POST["tenkh"];
                $tencty = $_POST["tencty"];
                $fax = $_POST["fax"];
                $diachi = $_POST["diachi"];
                $sdt = $_POST["sdt"];
                $mk = $_POST["mk"];

                if ($_POST['mahang'] == 'unselect') {
                    $error_id = '<span style ="color: red;">(*)</span>';
                } else {
                    $id = $_POST['mahang'];
                }
                if (strlen($tenkh) == 0 || strlen($diachi) == 0 || strlen($sdt) == 0 || strlen($mk) == 0)
                    echo '<div class="alert alert-danger alert-dismissible" >
                    <strong>Vui lòng nhập đầy đủ thông tin cần thiết</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" >
                    </button> 
                    </div>';
                else {
                    $sql = "CALL sp_themkh('$tenkh','$tencty','$sdt','$fax','$mk','$diachi')";
                    if ($conn->query($sql)) {
                        echo '<div class="alert  alert-success alert-dismissible">
                                <strong>Đăng ký thành công</strong> 
                                <button type="button" class="btn-close"data-bs-dismiss="alert">
                                </button>
                            </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible ">
                                <strong>Không thể đăng ký!</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" >
                                </button>
                            </div>';
                    }
                }
            }
            ?>
        </div>
    </section>
</div>
<?php include_once('footer.php') ?>