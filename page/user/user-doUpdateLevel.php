<?php
require_once("../../music-db-connect.php");

// if(!isset($_POST["level_name"])){
//     echo "請循正常管道進入本頁";
//     exit; 
// }

$id=$_POST["id"];
$level_name = $_POST["level_name"];

$sql="UPDATE user_level SET level_name='$level_name'  WHERE id =$id ";  

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新成功資料錯誤: " . 
    $conn->error;
}


header("location: user-level-detail.php"); 