<?php
require_once("../../music-db-connect.php");

if (!isset($_POST["class_name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$class_name = $_POST["class_name"];
$class_price = $_POST["class_price"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$course_name = $_POST["course_name"];
$course_info = $_POST["course_info"];
$information = $_POST["information"];

if($_FILES["class_img"]["error"] == 0){
    if(move_uploaded_file($_FILES["class_img"]["tmp_name"], "../../upload/class/". $_FILES["class_img"]["name"])){

        $image = $_FILES["class_img"]["name"];

        $now = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO class (class_name, class_price, class_img, start_date, end_date, course_name, course_info, information, create_time, class_valid)
        VALUES ('$class_name', '$class_price', '$image', '$start_date', '$end_date', '$course_name', '$course_info', '$information', '$now', 1)";

        if ($conn -> query($sql) === TRUE) {
            $last_id = $conn -> insert_id;
            // echo "新增資料完成, id: $last_id";
            header("location: class.php");
        } else {
            echo "新增資料錯誤: " . $conn -> error;
        }

    } else {
        echo "uploade fail!<br>";
    }
}


$conn->close();

//PHP跳轉
