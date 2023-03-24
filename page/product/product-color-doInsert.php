<?php
require_once("../../music-db-connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$name = $_POST["name"];

$sql = "INSERT INTO product_color (color_name) VALUES ('$name')";

if ($conn -> query($sql) === TRUE) {
    $last_id = $conn -> insert_id; //加上流水序號  
    echo "新增資料完成, id: $last_id";
} else {
    echo "新增資料錯誤: " . 
    $conn->error;
}

$conn->close();

header("location: product-color.php");
