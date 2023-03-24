<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入本頁";
    exit; 
}

$id = $_POST["id"];
$account = $_POST["account"];
$name = $_POST["name"];
$birthday = $_POST["birthday"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$user_img = $_POST["user_img"];
$user_level = $_POST["user_level"];

if($_FILES["user_img"]["error"] == 0){
    if(move_uploaded_file($_FILES["user_img"]["tmp_name"], "../../upload/user/". $_FILES["user_img"]["name"])){

        $image = $_FILES["user_img"]["name"];

        $now = date('Y-m-d H:i:s');

        $sql="UPDATE user SET user_name='$name', user_birthday='$birthday', user_mail='$email', user_phone='$phone',user_address='$address', user_img='$image',  user_level_id='$user_level' WHERE id='$id' ";
    }
}else{
    $user_img_old = $_POST["user_img_old"];
    $sql="UPDATE user SET user_name='$name', user_birthday='$birthday', user_mail='$email', user_phone='$phone',user_address='$address', user_img='$user_img_old',  user_level_id='$user_level' WHERE id='$id' ";

}


if ($conn -> query($sql) === TRUE) {

} else {
    echo "新增資料錯誤: " . $conn -> error;
}

//header("location: user-edit.php?id=".$id); //送出後停留在 user-edit
 header("location: user-detail.php?id=$id"); 