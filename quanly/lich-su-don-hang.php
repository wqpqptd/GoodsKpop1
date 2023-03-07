<?php
include('connect.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$rowperpage = 5;
$perrow = $page * $rowperpage - $rowperpage;

$totalrow = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dathang"));
$totalpage = ceil($totalrow / $rowperpage);

$listPage = "";
for ($i = 1; $i <= $totalpage; $i++) {
    if ($page == $i) {
        if ($listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=lich-su-don-hang&page='.$i.'">'.$i.'</a></li>');
    }   
    else
    {
        $listPage.='<li class="page-item"><a class="page-link" href="index.php?page_layout=lich-su-don-hang&page='.$i.'">'.$i.'</a></li>';
    }
}
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Lịch sử đơn hàng</h1>
    <div class="card mb-4">
        <div class="card-body">

        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Đơn hàng
        </div>
        <div class="card-body"> 
        <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>MSKH</th>
                        <th>MSNV</th>
                        <th>Ngày đặt hàng</th>
                        <th>Ngày giao hàng</th>
                        <th>Trạng thái</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('connect.php');
                    $sql = "SELECT * FROM donhang_view ORDER BY SoDonDH DESC LIMIT  $perrow,$rowperpage";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>" . $row['SoDonDH'] . "</td>
                            <td>" . $row['MSKH'] . "</td>
                            <td>" . $row['MSNV'] . "</td>
                            <td>" . $row['NgayDH'] . "</td>
                            <td>" . $row['NgayGH'] . "</td>
                            <td>" . $row['TenTrangThai'] . "</td>
                            <td>
                            <a href='index.php?page_layout=xem-don-hang&iddh=".$row['SoDonDH']."&idkh=".$row['MSKH']." '> <button type='button' class='btn btn-primary'>Xem</button>
                            </a>   
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
    </div>
</div>
