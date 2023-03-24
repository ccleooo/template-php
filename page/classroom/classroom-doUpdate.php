<?php
require_once("../../music-db-connect.php");

// if(!isset($_POST["class_name"])){
//     echo "請循正常管道進入本頁";
//     exit;
// }


$id=$_POST["id"];
$classroom_name=$_POST["classroom_name"];
$classroom_img=$_FILES["classroom_img"]["tmp_name"];
$reserve_price=$_POST["reserve_price"];
$classroom_info = $_POST["classroom_info"];


if($_FILES["classroom_img"]["error"] == 0){
    if(move_uploaded_file($_FILES["classroom_img"]["tmp_name"], "../../upload/classroom/". $_FILES["classroom_img"]["name"])){

        $image = $_FILES["classroom_img"]["name"];

        $now = date('Y-m-d H:i:s');

        $sql="UPDATE classroom SET classroom_name = '$classroom_name', classroom_img = '$image', reserve_price = '$reserve_price', classroom_info = '$classroom_info'
        WHERE id='$id'";
    }
}else{
    $old_img = $_POST["old_img"];
    $sql="UPDATE classroom SET classroom_name='$classroom_name', classroom_img = '$old_img', reserve_price='$reserve_price', classroom_info = '$classroom_info'
    WHERE id='$id'";

}


if ($conn -> query($sql) === TRUE) {
    header("location:classroom.php");
} else {
    echo "新增資料錯誤: " . $conn -> error;
}



