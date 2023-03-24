<?php
session_start();

require_once("../../music-db-connect.php");

if(!isset($_POST["admin_account"])){
    echo "請循正常管道進入";
    exit;
}

$admin_account=$_POST["admin_account"];
$admin_password=$_POST["admin_password"];


$sql="SELECT * FROM administrator
WHERE admin_account='$admin_account' AND admin_password='$admin_password'";
$result = $conn->query($sql);
$userCount = $result->num_rows;

if($userCount>0){
    $row = $result->fetch_assoc();
    unset($_SESSION["error"]);
    $_SESSION["user"]=[
        "admin_account"=>$row["admin_account"],

    ];
    // var_dump($row);
    header("location: user-admin.php");

}else{
    echo "登入失敗，請確認帳號或密碼";
    // if(!isset($_SESSION["error"]["times"])){
    //     $_SESSION["error"]["times"]=1; //錯誤次數
    // }else{
    //     $_SESSION["error"]["times"]++;
    // }
    
    $_SESSION["error"]["message"]="登入失敗，請確認帳號或密碼"; //把登入錯誤訊息記錄在["error"]["message"]裡面
    echo $_SESSION["error"];
    header("location: user-login.php");
}