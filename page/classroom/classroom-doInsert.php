<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["classroom_name"])){
    echo "請循正常管道進入本頁";
    exit;
}


$classroom_name =$_POST["classroom_name"];
$reserve_price =$_POST["reserve_price"];
$classroom_info = $_POST["classroom_info"];
//date_default_timezone_set("Asia/Taipei");
// $now =date('Y-m-d H:i:s');

if($_FILES["classroom_img"]["error"] == 0){
    if(move_uploaded_file($_FILES["classroom_img"]["tmp_name"], "../../upload/classroom/". $_FILES["classroom_img"]["name"])){

        $image = $_FILES["classroom_img"]["name"];

        $now = date('Y-m-d H:i:s');
        
        $sql="INSERT INTO classroom (classroom_name, classroom_img, reserve_price,classroom_info,  class_order_vaild)
        VALUES ('$classroom_name', '$image', '$reserve_price', '$classroom_info', 1)";
        
        if ($conn -> query($sql) === TRUE) {
            $last_id = $conn -> insert_id;
            // echo "新增資料完成, id: $last_id";
            header("location: classroom.php");        
        } else {
            echo "新增資料錯誤: " . $conn -> error;
        }

    } else {
        echo "uploade fail!<br>";
    }
}


$conn->close();


