<?php
include('connect.php');
$id=$_GET['id'];
$sql1="DELETE FROM hinhhanghoa WHERE MSHH='$id'";
$sql="DELETE FROM hanghoa WHERE MSHH='$id' ";
$query1=mysqli_query($conn,$sql1);
$query=mysqli_query($conn,$sql);

header('location: index.php?page_layout=hang-hoa');

?>