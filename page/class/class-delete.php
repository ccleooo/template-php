<?php
require_once("../../music-db-connect.php");


$id=$_GET["id"];


$sql="UPDATE class SET class_valid=0 where id='$id'";

// echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    header("location:class.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}