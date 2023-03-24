<?php
require_once("../../music-db-connect.php");


$id=$_GET["id"];

$sql="UPDATE class_order SET Class_order_valid=0 where id='$id'";


if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    header("location:class-order.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}