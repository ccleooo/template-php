<?php
require_once("../../music-db-connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$id = $_POST["id"];
$subject_img = $_FILES["subject_img"]["tmp_name"];
$status = $_POST["status"];
$category = $_POST["category"];
$spec = $_POST["spec"];
$name = $_POST["name"];
$price = $_POST["price"];
$inventory = $_POST["inventory"];
$color = implode(',', $_POST["color"]);
$information = $_POST["information"];


if ($_FILES["subject_img"]["error"] == 0) {
    (move_uploaded_file($_FILES["subject_img"]["tmp_name"], "../../upload/product-subject/" . $_FILES["subject_img"]["name"]));

    $image = $_FILES["subject_img"]["name"];

    $sql = "UPDATE product SET subject_img = '$image', product_valid = '$status', category_id = '$category', spec_id = '$spec', product_name = '$name', product_price = '$price', inventory = '$inventory', color_id = '$color', information = '$information' WHERE id = '$id'";

} else {
    $subject_img_old = $_POST["subject_img_old"];

    $sql = "UPDATE product SET subject_img = '$subject_img_old', product_valid = '$status', category_id = '$category', spec_id = '$spec', product_name = '$name', product_price = '$price', inventory = '$inventory', color_id = '$color', information = '$information' WHERE id = '$id'";
}


if (!empty($_FILES['product_img']['name'])){
    $id = $_POST["id"];
    $ins = 0;
    foreach ($_FILES["product_img"]["name"] as $key => $name) {
        $filename = date('Ymd-his') . "_" . $name;
        if (!is_dir('product_img'))
            mkdir('product_img');
        $save_location = '../../upload/product/' . $filename;
        $move = move_uploaded_file($_FILES['product_img']['tmp_name'][$key], $save_location);
        if ($move) {
            $insert = mysqli_query($conn, "INSERT INTO product_image (product_id, src) VALUES ('$id', '$filename')");
            if ($insert)
                $ins++;
        }
    }
}

if ($conn -> query($sql) === TRUE) {
    echo "更新成功";

} else {
    echo "更新資料錯誤: " . $conn -> error;
}

header("location: product-edit.php?id=" . $id);


$conn->close();
