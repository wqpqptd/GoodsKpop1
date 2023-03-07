<?php
include('connect.php');
$id=$_GET['id'];
$sql="DELETE FROM loaihanghoa WHERE MaLoaiHang='$id' ";
$query=mysqli_query($conn,$sql);
header('location: index.php?page_layout=loai-hang');

?>