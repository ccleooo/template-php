<?php
require_once("../../music-db-connect.php");

$id = $_POST["id"];
$user_password = $_POST["user_password"];
$user_password = md5($user_password);

$sql = "UPDATE user SET user_password = '$user_password' WHERE id = $id ";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";

} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location: user-edit.php?id=$id");