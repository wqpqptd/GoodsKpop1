<?php
include('connect.php');
$sqlid = "SELECT * FROM loaihanghoa";
$queryid = mysqli_query($conn, $sqlid);
?>
<!-- Header -->
<div class="header  pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0">Chỉnh sửa hàng hóa</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('connect.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_ds = "SELECT * from hanghoa inner join loaihanghoa 
                on hanghoa.MaLoaiHang = loaihanghoa.MaLoaiHang
                where MSHH = '$id' ";
    $sqlimg = "SELECT * FROM hinhhanghoa WHERE MSHH='$id'";
    $queryimg = mysqli_query($conn, $sqlimg);
    $rowimg = mysqli_fetch_array($queryimg);
    $ds = $conn->query($sql_ds);
    if ($ds) {
        foreach ($ds as $row) {

?>
            <!-- Page content -->
            <div class="container-fluid mt--6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!--Anh minh hoa-->
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-7">
                                            <h3 class="mb-0">Ảnh mô tả </h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="file-upload" value="<?php echo $rowimg['TenHinh'] ?>">
                                        <img src="<?php echo $rowimg['TenHinh'] ?>" alt="ảnh sản phẩm" width="220px">
                                    </div>
                                    <label class="form-control-label" for="img">Thay đổi ảnh </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input " name="file-upload">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Thong tin san pham-->
                        <div class="col-lg-8 col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-7">
                                            <h3 class="mb-0">Thông tin</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="id">Mã hàng hóa</label>
                                                    <span name="id" class="form-control"><?php echo $row['MSHH'] ?> </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="tenhang">Tên hàng hóa</label>
                                                    <input type="text" name="tenhang" class="form-control" placeholder="Tên sản phẩm" value="<?php echo $row['TenHH'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="mahang">Loại hàng</label>
                                                    <span class="text-danger" data-toggle="tooltip" data-placement="left" title="Thông tin bắt buộc nhập">(*)</span>
                                                    <select name="mahang" class="form-control">
                                                        <?php
                                                        while ($rowid = mysqli_fetch_array($queryid)) {
                                                        ?>
                                                            <option 
                                                                <?php 
                                                                if($row['MaLoaiHang'] == $rowid['MaLoaiHang'])
                                                                {
                                                                    echo 'selected ="selected"';
                                                                }

                                                                ?>
                                                                value="<?php echo $rowid['MaLoaiHang']; ?>"> <?php echo $rowid['TenLoaiHang'];?>

                                                            </option>
                                                            
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="gia">Giá</label>
                                                    <input type="price" name="gia" class="form-control" placeholder="VND" value="<?php echo $row['Gia'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="soluong">Số lượng</label>
                                                    <input type="text" name="soluong" class="form-control" placeholder="Số lượng" value="<?php echo $row['SoLuongHang'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr class="my-4" />
                                    <!-- Description -->
                                    <div class="pl-lg-4 mb-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Quy cách</label>
                                            <textarea name="quycach" rows="4" class="form-control" placeholder="Mô tả chi tiết sản phẩm"><?php echo $row['QuyCach'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-2 ">
                                            <div class="form-group">
                                                <a href="index.php?page_layout=hang-hoa" class="btn btn-sm btn-outline-primary">Quay lại</a>
                                            </div>
                                        </div>
                                        <div class="col-2 ">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-sm btn-primary" name="edit-save" value="Xác Nhận">
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
            $id = $_GET['id'];
            if (isset($_POST["edit-save"])) {
                $ten = $_POST["tenhang"];
                $gia = $_POST["gia"];
                $soluong = $_POST["soluong"];
                $quycach = $_POST["quycach"];

                if($_FILES['file-upload']['name']=="")
                {
                    $anh_hh=$_POST['file-upload'];
                }
                else
                {
                    $anh_hh=$_FILES['file-upload']['name'];
                    $tmp_name=$_FILES['file-upload']['tmp_name'];
                    $link='img/';
                }

                $idlh=$_POST['mahang'];

                if (strlen($ten) == 0 || strlen($idlh) == 0 || strlen($gia) == 0 || strlen($soluong) == 0)
                    echo '<div class="alert alert-danger alert-dismissible" >
                <strong>Vui lòng nhập đầy đủ thông tin</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" >
                </button> 
                </div>';
            
                else {  
                        
                    $sql="CALL sp_suahanghoa('$ten','$quycach','$gia','$soluong','$idlh','$link$anh_hh','$id')";
                        if ($conn->query($sql)) {
                            echo '<div class="alert  alert-success alert-dismissible" role="alert">
                                     <strong>Sửa thành công</strong> 
                                     <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>';
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible " role="alert">
                                 <strong>Không thể sửa!</strong> 
                                 <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>';
                        }
                    
                }
            }

            ?>

