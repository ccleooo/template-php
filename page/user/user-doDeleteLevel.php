<?php
require_once("../../music-db-connect.php");

$id=$_GET['id'];

$sql="DELETE FROM user_level WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "資料刪除成功";
} else {
    echo "刪除資料錯誤: " . 
    $conn->error;
}

// $conn->close();

header("location: user-level-detail.php");

?>

