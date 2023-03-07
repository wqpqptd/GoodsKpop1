<?php
include('connect.php');
$id = $_GET['id'];
$sql = "SELECT * FROM loaihanghoa WHERE MaLoaiHang=$id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);


?>

<div class="container-fluid px-4">

    <h1 class="mt-4">Chỉnh sửa loại hàng</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-5">Tên loại hàng</h4>


            <form action="" method="POST">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="form-group">
                            <input type="text" name="tenlh" class="form-control" placeholder="Tên loại hàng" value="<?php echo $row['TenLoaiHang'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-1">
                        <div class="form-group">
                            <a href="index.php?page_layout=loai-hang" class="btn btn-sm btn-outline-primary">Quay lại</a>
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
        if (isset($_POST["submit"])) {
            $id = $_GET["id"];
            $new = $_POST["tenlh"];
            if (strlen($new) == 0)
            echo '<div class="alert alert-warning alert-dismissible" >
            <strong>Vui lòng nhập tên loại hàng</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" >
            </button> 
         </div>';
            else {

                $sql_update = "UPDATE loaihanghoa SET TenLoaiHang= '$new' where MaLoaiHang='$id'";

                if ($conn->query($sql_update)) {
                    echo "<meta http-equiv='refresh' content='0'>";
                } else {
                    echo '<div class="alert alert-warning alert-dismissible ">
                        <strong>Không thể sửa!</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" >
                        </button>
                    </div>';
                }
            }
        }


        ?>

    </div>
</div>




