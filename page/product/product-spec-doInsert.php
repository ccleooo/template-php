<?php
require_once("../../music-db-connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$name = $_POST["name"];
$description = $_POST["description"];

$sql = "INSERT INTO product_spec (spec_name, spec_description) VALUES ('$name', '$description')";

if ($conn -> query($sql) === TRUE) {
    $last_id = $conn -> insert_id; //加上流水序號  
    echo "新增資料完成, id: $last_id";
} else {
    echo "新增資料錯誤: " . 
    $conn->error;
}

$conn->close();

header("location: product-spec.php");
