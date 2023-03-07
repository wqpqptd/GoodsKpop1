<?php
include('connect.php');
$sqlid = "SELECT * FROM loaihanghoa";
$queryid = mysqli_query($conn, $sqlid);

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Thêm mới hàng hóa</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-4">Thông tin</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="form-group">
                            <label class="form-control-label" for="tenhang">Tên hàng</label>
                            <span class="text-danger" data-toggle="tooltip" data-placement="left" title="Thông tin bắt buộc nhập">(*)</span>
                            <input type="text" name="tenhang" class="form-control" placeholder="Tên sản phẩm" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="form-group">
                            <label class="form-control-label" for="mahang">Loại hàng</label>
                            <span class="text-danger" data-toggle="tooltip" data-placement="left" title="Thông tin bắt buộc nhập">(*)</span>
                            <select name="mahang" class="form-control">
                                <option value="unselect" selected> Lựa chọn loại hàng</option>
                                <?php
                                while ($rowid = mysqli_fetch_array($queryid)) {
                                ?>
                                    <option value="<?php echo $rowid['MaLoaiHang']; ?>"><?php echo $rowid['TenLoaiHang']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 ">
                        <div class="form-group">
                            <label class="form-control-label" for="gia">Giá</label>
                            <span class="text-danger" data-toggle="tooltip" data-placement="left" title="Thông tin bắt buộc nhập">(*)</span>
                            <input type="price" name="gia" class="form-control" placeholder="VND">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label class="form-control-label" for="soluong">Số lượng</label>
                            <span class="text-danger" data-toggle="tooltip" data-placement="left" title="Thông tin bắt buộc nhập">(*)</span>
                            <input type="text" name="soluong" class="form-control" placeholder="Số lượng" value="">
                        </div>
                    </div>
                </div>



                <hr class="my-4" />
                <!-- Description -->
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="form-group">
                                <label class="form-control-label">Quy cách</label>
                                <textarea name="quycach" rows="4" class="form-control" placeholder="Mô tả chi tiết sản phẩm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="form-group">
                                <label class="form-control-label">Ảnh minh họa</label>
                                <span class="text-danger" data-toggle="tooltip" data-placement="left" title="Thông tin bắt buộc nhập">(*)</span>
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="file-upload">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <div class="form-group">
                            <a href="index.php?page_layout=hang-hoa" class="btn btn-sm btn-outline-primary">Quay lại</a>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary" name="submit">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="ml-4 mr-4">
        <?php
        include('connect.php');
        if (isset($_POST["submit"])) {
            $ten = $_POST["tenhang"];
            $gia = $_POST["gia"];
            $soluong = $_POST["soluong"];
            $quycach = $_POST["quycach"];
            
            if ($_POST['mahang'] == 'unselect') {
                $error_id = '<span style ="color: red;">(*)</span>';
            } else {
                $id = $_POST['mahang'];
            }
            if (strlen($ten) == 0 || strlen($id) == 0 || strlen($gia) == 0 || strlen($soluong) == 0)
                echo '<div class="alert alert-danger alert-dismissible" >
            <strong>Vui lòng nhập đầy đủ thông tin</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" >
            </button> 
            </div>';
            else {
                $link='img/'.$_FILES['file-upload']['name'];
                move_uploaded_file($_FILES['file-upload']['tmp_name'],$link);
                $sql="CALL sp_themhanghoa('$ten','$quycach','$gia','$soluong','$id','$link')";
                    if ($conn->query($sql)) {
                        echo '<div class="alert  alert-success alert-dismissible">
                        <strong>Thêm thành công</strong> 
                        <button type="button" class="btn-close"data-bs-dismiss="alert">
                        </button>
                    </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible ">
                        <strong>Không thể thêm!</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" >
                        </button>
                    </div>';
                    }
                
            }
        }
        ?>
    </div>
</div>

