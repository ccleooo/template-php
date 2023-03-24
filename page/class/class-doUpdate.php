<?php
require_once("../../music-db-connect.php");

if (!isset($_POST["class_name"])) {
    echo "請循正常管道進入本頁";
    exit;
}


$id = $_POST["id"];
$class_name = $_POST["class_name"];
$class_price = $_POST["class_price"];
$class_img=$_FILES["class_img"]["tmp_name"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$course_name = $_POST["course_name"];
$course_info = $_POST["course_info"];
$information = $_POST["information"];

if($_FILES["class_img"]["error"] == 0){
    if(move_uploaded_file($_FILES["class_img"]["tmp_name"], "../../upload/class/". $_FILES["class_img"]["name"])){

        $image = $_FILES["class_img"]["name"];

        $now = date('Y-m-d H:i:s');

    $sql = "UPDATE class SET class_name = '$class_name', class_price = '$class_price', class_img = '$image', start_date = '$start_date', end_date = '$end_date', course_name = '$course_name', course_info = '$course_info', information = '$information' 
    WHERE id='$id'";
    }
}else{
    $old_img = $_POST["old_img"];
    $sql = "UPDATE class SET class_name = '$class_name', class_price = '$class_price', class_img = '$old_img', start_date = '$start_date', end_date = '$end_date', course_name = '$course_name', course_info = '$course_info', information = '$information' 
    WHERE id='$id'";

}


if ($conn -> query($sql) === TRUE) {

} else {
    echo "新增資料錯誤: " . $conn -> error;
}

header("location: class-detail.php?id=$id");
