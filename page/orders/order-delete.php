<?php
require_once("../../music-db-connect.php");

$id=$_GET["id"];


//soft delete
$sql="UPDATE orders SET valid=0 WHERE id='$id'";

//echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    header("location: orders.php");
   } else {
    echo "刪除資料錯誤: " . $conn->error;
   }

