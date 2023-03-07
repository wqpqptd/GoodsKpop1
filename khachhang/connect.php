<?php
error_reporting(0);
    $conn=new mysqli("localhost","root","","coffee");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>