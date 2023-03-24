<?php
require_once("../../music-db-connect.php");


$img_id = $_GET["img_id"];
$product_id = $_GET["product_id"];

// DELETE FROM <資料表名稱> WHERE id = <要刪除的資料 ID>
$sql = "DELETE FROM product_image WHERE id = '$img_id'";

if ($conn -> query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn -> error;
}
header("location: product-edit.php?id=".$product_id);
?>