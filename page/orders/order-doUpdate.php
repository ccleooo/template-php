<?php
require_once("../../music-db-connect.php");

// if(!isset($_POST["name"])){
//     echo "請循正常管道進入本頁";
//     exit;
// }

$id=$_POST["id"];
$order_phone=$_POST["order_phone"];
$order_address=$_POST["order_address"];
$take_method=$_POST["take_method"];
$pay_method=$_POST["pay_method"];
$freight = $_POST["freight"];
$pay_status=$_POST["pay_status"];
$update_status=$_POST["update_status"];
$order_status=$_POST["order_status"];


// echo "$name, $phone, $email";


$sql = "UPDATE orders SET order_phone = '$order_phone', order_address = '$order_address', pay_method = '$pay_method', freight='$freight', take_method = '$take_method', pay_status = '$pay_status', update_status = '$update_status', order_status = '$order_status' WHERE id =$id ";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";

} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location: order-detial.php?id=$id");