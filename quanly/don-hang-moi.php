<div class="container-fluid px-4">
    <h1 class="mt-4">Xác nhận đơn hàng</h1>
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
                    $sql = "SELECT * FROM donhang_view ORDER BY SoDonDH DESC";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        if($row['TrangThaiDH']!=3)
                        {
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
                           </td>
    
                        </tr>";
                        }

                    
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
