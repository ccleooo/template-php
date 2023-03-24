<?php
require_once("../../music-db-connect.php");

$id=$_GET["id"];
// $sql="DELETE FROM users WHERE id='$id'";
$sql="UPDATE user SET user_valid=0 WHERE id='$id'";
// echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "刪除會員成功";
    header("location: user.php");
} else {
    echo "刪除會員錯誤: " . 
    $conn->error;
}