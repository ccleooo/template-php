<?php
require_once("../../music-db-connect.php");

// if(!isset($_POST["class_name"])){
//     echo "請循正常管道進入本頁";
//     exit;
// }


$id=$_POST["id"];
// $user_account=$_POST["user_account"];
$classroom_id=$_POST["classroom_id"];
$order_price=$_POST["order_price"];
$reserve_date = $_POST["reserve_date"];
$reserve_time = $_POST["reserve_time"];


$sql="UPDATE classroom_reserve SET classroom_id='$classroom_id', order_price='$order_price',reserve_date='$reserve_date' ,reserve_time='$reserve_time'
 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location:classroom-reserve.php");//更新完回到使用者編輯那一頁
