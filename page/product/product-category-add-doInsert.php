<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入本頁";
    exit;
}
$id=$_POST["id"];
$name=$_POST["name"];

$sql="INSERT INTO product_category (category_name, product_valid)
VALUES ('$name', 1)";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "新增資料完成, id: $last_id";
} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();

header("location: product-category.php");
