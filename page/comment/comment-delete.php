
<?php
require_once("../../music-db-connect.php");

$id=$_GET["id"];
$sql="DELETE FROM comment WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    header("location: comment-list.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
