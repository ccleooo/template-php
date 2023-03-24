<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["admin_password"])){
    echo "請循正常管道進入本頁";
    exit; 
}

$id = $_POST["id"];
$admin_password = $_POST["admin_password"];

// [input的name值]>>post到後端要去接住的變數

// echo "$name, $phone, $email";

$sql="UPDATE administrator SET admin_password='$admin_password' WHERE id='$id' ";  

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新成功資料錯誤: " . 
    $conn->error;
}

// echo $sql;
header("location: user-admin.php"); 