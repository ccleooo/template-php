<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["user_id"])){
    echo "請循正常管道進入本頁";
    exit;
}

$user_id = $_POST["user_id"];
$product_id = $_POST["product_id"];
$comment = $_POST["comment"];
$now = date('Y-m-d H:i:s');

$sql="INSERT INTO comment (user_id, product_id, comment, create_time)
VALUES ('$user_id', '$product_id', '$comment', '$now')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "新增資料完成, id: $last_id";
} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();

header("location: comment-list.php");
