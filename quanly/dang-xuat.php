<?php
session_start();
if(isset($_SESSION['SDT']))
{
    session_destroy();
    header('location: dang-nhap.php');

}
else
{
    header('location: dang-nhap.php');
}

?>