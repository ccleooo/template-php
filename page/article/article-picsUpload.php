<?php
require_once("../../music-db-connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$name = $_POST["name"];

// echo $name;

if ($_FILES["myFile"]["error"] == 0) {
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], "../../upload/article/" . $_FILES["myFile"]["name"])) {
        echo "uploade success!<br>";
        $now = date('Y-m-d H:i:s');

        $image = $_FILES["myFile"]["name"];

        // echo "$name, $phone, $email, $now";

        $sql = "INSERT INTO images (name, image , created_at)
        VALUES ('$name','$image' ,'$now')";
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            // echo "新增資料完成, id: $last_id";
            header("location: article-add.php");
        } else {
            echo "新增資料錯誤: " . $conn->error;
        }
    } else {
        echo "uploade fail!<br>";
    }
}

// var_dump($_FILES["myFile"]);
