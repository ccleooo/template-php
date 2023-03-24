<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["title"])){
    echo "請循正常管道進入本頁";
    exit;
}

$title=$_POST["title"];
$content=$_POST["content"];
$category=$_POST["category"];


if($_FILES["myFile"]["error"] == 0){
    if(move_uploaded_file($_FILES["myFile"]["tmp_name"], "../../upload/article/". $_FILES["myFile"]["name"])){
        echo "uploade success!<br>";

        $image = $_FILES["myFile"]["name"];

        $now = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO article (article_category_id , article_title, create_time, article_content, article_img) VALUES ('$category', '$title', '$now', '$content', '$image')"; 

        if ($conn -> query($sql) === TRUE) {
            $last_id = $conn -> insert_id;
            // echo "新增資料完成, id: $last_id";
            header("location: article-list.php");
                } else {
            echo "新增資料錯誤: " . $conn -> error;
        }

    } else {
        echo "uploade fail!<br>";
    }
}

$conn->close();


