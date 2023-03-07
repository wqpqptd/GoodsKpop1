<title>Nhân viên</title>

<div class="container-fluid px-4">
    <h1 class="mt-4">Danh sách nhân viên</h1>
    <div class="card mb-4">
        <div class="card-body">

        
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Nhân viên
        </div>
        <div class="card-body">
        <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã nhân viên</th>
                        <th>Tên nhân viên</th>
                        <th>Chức vụ</th>
                        <th>Địa chỉ</th>
                        <th>SDT</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('connect.php');
                    $sql = "SELECT * FROM nhanvien";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>" . $row['MSNV'] . "</td>
                            <td>" . $row['HoTenNV'] . "</td>
                            <td>" . $row['ChucVu'] . "</td>
                            <td>" . $row['DiaChi'] . "</td>
                            <td>" . $row['SoDienThoai'] . "</td>

                    </tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
