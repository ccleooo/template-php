<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["title"])){
    echo "請循正常管道進入本頁";
    exit;
}

$id=$_POST["id"];
$title=$_POST["title"];
$content=$_POST["content"];
$article_img = $_FILES["article_img"]["tmp_name"];


if ($_FILES["article_img"]["error"] == 0) {
    (move_uploaded_file($_FILES["article_img"]["tmp_name"], "../../upload/article/" . $_FILES["article_img"]["name"]));

    $image = $_FILES["article_img"]["name"];

    $sql="UPDATE article SET article_title='$title', article_content='$content', article_img='$image' WHERE id='$id'";

} else {
    $old_img = $_POST["old_img"];

    $sql="UPDATE article SET article_title='$title', article_content='$content', article_img='$old_img' WHERE id='$id'";
}

if ($conn->query($sql) === TRUE) {
    echo "更新成功";

} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("location: article-detail.php?id=$id");