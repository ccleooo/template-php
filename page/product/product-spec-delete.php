
<?php
require_once("../../music-db-connect.php");

$id = $_GET["id"];

$sql = "DELETE FROM product_spec WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

header("location: product-spec.php");
