<?php
require_once("../../music-db-connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入本頁";
    exit;
}

$status = $_POST["status"];
$category = $_POST["category"];
$spec = $_POST["spec"];
$name = $_POST["name"];
$price = $_POST["price"];
$inventory = $_POST["inventory"];
$color = implode(',',$_POST["color"]);
$information = $_POST["information"];

if($_FILES["subject_img"]["error"] == 0){
    if(move_uploaded_file($_FILES["subject_img"]["tmp_name"], "../../upload/product-subject/". $_FILES["subject_img"]["name"])){
        echo "uploade success!<br>";

        $image = $_FILES["subject_img"]["name"];

        $now = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO product (subject_img, product_valid, category_id, spec_id, product_name, product_price, inventory, color_id, information, create_time) VALUES ('$image', '$status', '$category', '$spec', '$name', '$price', '$inventory', '$color', '$information', '$now')"; 

        if ($conn -> query($sql) === TRUE) {
            $last_id = $conn -> insert_id;
            // echo "新增資料完成, id: $last_id";
            header("location: product-add.php");
        } else {
            echo "新增資料錯誤: " . $conn -> error;
        }

    } else {
        echo "uploade fail!<br>";
    }
}

$ins = 0;
foreach($_FILES["product_img"]["name"] as $key => $name){
    $filename = date('Ymd')."_".$name;
    if(!is_dir('product_img'))
        mkdir('product_img');
    $save_location = '../../upload/product/'.$filename;
    $move = move_uploaded_file($_FILES['product_img']['tmp_name'][$key], $save_location);
    if($move){
        $insert = mysqli_query($conn,"INSERT INTO product_image (product_id, src) VALUES ('$last_id', '$filename')");
        if($insert)
        $ins++;
    }
    if(count($_FILES["product_img"]["name"]) == $ins){
        header("location: product-add.php");
    }
}

$conn->close();
