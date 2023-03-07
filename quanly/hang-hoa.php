<script>
    function XoaHangHoa() {
        var conf = confirm("Chắc chắn xóa ?");
        return conf;
    }
</script>
<?php
include('connect.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$rowperpage = 8;
$perrow = $page * $rowperpage - $rowperpage;

$totalrow = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hanghoa_view"));
$totalpage = ceil($totalrow / $rowperpage);

$listPage = "";
for ($i = 1; $i <= $totalpage; $i++) {
    if ($page == $i) {
        if ($listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=hang-hoa&page='.$i.'">'.$i.'</a></li>');
    }   
    else
    {
        $listPage.='<li class="page-item"><a class="page-link" href="index.php?page_layout=hang-hoa&page='.$i.'">'.$i.'</a></li>';
    }
}
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý hàng hóa</h1>
    <div class="card mb-4">
        <div class="card-body">
            <a href="index.php?page_layout=them-hang-hoa">
                <button type="button" class="btn btn-primary">Thêm hàng hóa </button>
            </a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Hàng hóa (Tổng: <?php echo $totalrow; ?> )
        </div>
        <!--  table -->
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã hàng</th>
                        <th>Tên hàng</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Loại hàng</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('connect.php');
                    $sql = "SELECT * FROM hanghoa_view ORDER BY MSHH  LIMIT  $perrow,$rowperpage";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr >
                            <td>" . $row['MSHH'] . "</td>
                            <td>" . $row['TenHH'] . "</td>
                            <td>" . $row['Gia'] . " </td>
                            <td>" . $row['SoLuongHang'] . "</td>
                            <td>" . $row['TenLoaiHang'] . "</td>
                            <td>
                            <a href='index.php?page_layout=chinh-sua-hang-hoa&id=" . $row['MSHH'] . " '> <button type='button' class='btn btn-primary'>Sửa</button>
                            </a>     
                            <td>
                            <a onClick='return XoaHangHoa();' href='xoa-hang-hoa.php?id=" . $row['MSHH'] . " '><button type='button' class='btn btn-primary'> Xóa </button> </a> 
                            </td>
                            
                       </td>
                    </tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <ul class="pagination justify-content-end">
                    <?php
                    echo $listPage;
                    ?>
            </ul>
        </div>
        <!--  -->
    </div>
</div>
