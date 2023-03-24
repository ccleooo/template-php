<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入本頁";
    exit;
}

$id = $_POST["id"];
$name = $_POST["name"];
$description = $_POST["description"];

$sql = "UPDATE product_spec SET spec_name = '$name', spec_description = '$description' WHERE id = $id ";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";

} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location: product-spec.php");