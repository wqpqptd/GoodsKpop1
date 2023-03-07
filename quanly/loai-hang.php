<script>
    function XoaDanhMuc()
    {
        var conf=confirm("Chắc chắn xóa ?");
        return conf;
    }
</script>

<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý loại hàng</h1>
    <div class="card mb-4">
        <div class="card-body">
            <a href="index.php?page_layout=them-loai-hang">
                <button type="button" class="btn btn-primary">Thêm mới loại hàng</button>

            </a>

        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Hàng hóa
        </div>
        <!--  table -->
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã loại hàng</th>
                        <th>Tên loại hàng</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('connect.php');
                    $sql = "SELECT * FROM loaihanghoa";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>" . $row['MaLoaiHang'] . "</td>
                            <td>" . $row['TenLoaiHang'] . "</td>
                            <td>
                                 <a href='index.php?page_layout=chinhsualoaihang&id=".$row['MaLoaiHang']." '> <button type='button' class='btn btn-primary'>Sửa</button>
                                 </a>     
                            </td>
                            <td>
                            <a onClick='return XoaDanhMuc();' href='xoa-loai-hang.php?id=".$row['MaLoaiHang']." '><button type='button' class='btn btn-primary'> Xóa </button> </a> 
                            </td>
                    </tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
