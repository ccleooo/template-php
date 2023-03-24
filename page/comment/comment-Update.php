<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["comment"])){
    echo "請循正常管道進入本頁";
    exit;
}

$id=$_POST["id"];
// $user_id=$_POST["user_id"];
// $product_id=$_POST["product_id"];
$comment=$_POST["comment"];


// $sql="UPDATE comment SET user_id='$user_id', product_id='$product_id', comment='$comment' WHERE id='$id'";
$sql="UPDATE comment SET comment='$comment' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";

} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location: comment-edit.php?id=".$id);