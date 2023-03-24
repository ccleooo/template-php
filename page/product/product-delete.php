<?php
require_once("../../music-db-connect.php");

$id = $_GET["id"];
$sql = "DELETE FROM product WHERE id='$id'";


// echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    header("location: product.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

