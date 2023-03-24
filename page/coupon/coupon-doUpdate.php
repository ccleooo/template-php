<?php
require_once("../../music-db-connect.php");


if(!isset($_POST["coupon_name"])){
    echo "請循正常管道進入本業";
    exit;
}

$sn=$_POST["sn"];
$coupon_name=$_POST["coupon_name"];
$discount=$_POST["discount"];
$quota=$_POST["quota"];
$start_time=$_POST["start_time"];
$end_time=$_POST["end_time"];


$sql="UPDATE coupon SET coupon_name='$coupon_name', discount='$discount',quota='$quota',start_time='$start_time',end_time='$end_time' WHERE sn='$sn'"; 



if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location:coupon.php");

