<?php
require_once("../../music-db-connect.php");


$sn=$_GET["id"];
$sql="DELETE FROM coupon WHERE sn='$sn'";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    header("location:coupon.php");

} else {
    echo "刪除資料錯誤: " . $conn->error;
}

?>