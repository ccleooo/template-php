<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入本頁";
    exit;
}

$id=$_POST["id"];
$name=$_POST["name"];


$sql="UPDATE product_category SET category_name='$name' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";

} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location: product-category.php?id=".$id);
