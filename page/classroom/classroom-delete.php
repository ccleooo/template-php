<?php
require_once("../../music-db-connect.php");


$id=$_GET["id"];

$sql="UPDATE classroom SET class_order_vaild=0 where id='$id'";


if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    header("location:classroom.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}