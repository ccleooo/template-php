<?php
require_once("../../music-db-connect.php");

// if(!isset($_POST["class_name"])){
//     echo "請循正常管道進入本頁";
//     exit;
// }


$id=$_POST["id"];
$order_phone=$_POST["order_phone"];
$class_id=$_POST["class_id"];
$order_price=$_POST["order_price"];



//echo "$user_phone,$class_name,$order_price";

$sql="UPDATE class_order SET order_phone='$order_phone', class_id='$class_id' ,order_price='$order_price'
 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location:class-order-edit.php?id=$id");//更新完回到使用者編輯那一頁