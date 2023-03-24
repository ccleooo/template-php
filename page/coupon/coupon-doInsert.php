<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["coupon_name"])){
    echo "請循正常管道進入本頁";
    exit;
}


$sn=$_POST["sn"];
$coupon_name=$_POST["coupon_name"];
$discount=$_POST["discount"];
$quota=$_POST["quota"];
$start_time=$_POST["start_time"];
$end_time=$_POST["end_time"];

// date_default_timezone_set("Asia/Taipei");
$now=date('Y-m-d H:i:s');


$sql="INSERT INTO coupon (sn,coupon_name,discount,quota,start_time,end_time,create_time,valid)
VALUES ('$sn','$coupon_name','$discount','$quota','$start_time','$end_time','$now',1)";

if ($conn->query($sql) === TRUE) {
    // $last_sn = $conn -> insert_sn;
    echo "新增資料完成" ;
} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();

header("location:coupon.php");