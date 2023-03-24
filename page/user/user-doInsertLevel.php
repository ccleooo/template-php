<?php
require_once("../../music-db-connect.php");

if (!isset($_POST["level_name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$level_name = $_POST["level_name"];

$sql = "INSERT INTO user_level (level_name)
VALUES ('$level_name')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id; //加上流水序號  
    echo "新增資料完成, id: $last_id";
} else {
    echo "新增資料錯誤: " .
        $conn->error;
}

$conn->close();

//php跳轉
header("location: user-level-detail.php");
