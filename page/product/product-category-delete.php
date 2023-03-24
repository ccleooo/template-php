<?php
require_once("../../music-db-connect.php");

$id=$_GET["id"];
// $sql="DELETE FROM users WHERE id='$id'";
//soft delete
$sql="UPDATE product_category SET product_valid=0 WHERE id='$id'";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    header("location: product-category.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

?>