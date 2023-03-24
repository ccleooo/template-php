<?php
require_once("../../music-db-connect.php"); 

if(!isset($_POST["name"])){
    echo "請循正常管道進入本頁";
    exit; 
}

$account = $_POST["account"];
$password = $_POST["password"];
$password=md5($password);
$name = $_POST["name"];
$birthday = $_POST["birthday"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$user_level = $_POST["user_level"];
$now = date('Y-m-d H:i:s'); //抓取現在時間
 
// echo "$name, $phone, $email, $now";
if($_FILES["user_img"]["error"] == 0){
    if(move_uploaded_file($_FILES["user_img"]["tmp_name"], "../../upload/user/". $_FILES["user_img"]["name"])){

        $image = $_FILES["user_img"]["name"];

        $now = date('Y-m-d H:i:s');
        
        $sql="INSERT INTO user (user_account, user_password, user_name, user_birthday, user_mail, user_phone, user_address, user_img, user_level_id, create_time, user_valid)
        VALUES ('$account', '$password', '$name', '$birthday',  '$email', '$phone', '$address','$image', '$user_level','$now', 1)";

        if ($conn -> query($sql) === TRUE) {
            $last_id = $conn -> insert_id;
            header("location: user.php");
            
        } else {
            echo "新增資料錯誤: " . $conn -> error;
        }

    } else {
        echo "uploade fail!<br>";
    }
}


$conn->close();
header("location: user.php");

