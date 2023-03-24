<?php
require_once("../../music-db-connect.php");

if(!isset($_GET["id"])){
    echo "訂單不存在";
    exit;
}

$id=$_GET["id"];
//var_dump($id);

//-----購買商品列表----
if(isset($_GET["id"])){
    $order=$_GET["id"];

    $sql="SELECT order_product.*, product.product_name, product.product_price, product.subject_img FROM order_product
    JOIN product ON order_product.product_id = product.id 
    WHERE order_product.id = $order  ";
    $resultAll = $conn->query($sql); 
    $orderRowsCount=$resultAll->num_rows;
    $orderRows=$resultAll->fetch_all(MYSQLI_ASSOC); 
    //var_dump($orderRows);
}

if(isset($_GET["id"])){
    $order_product=$_GET["id"];

    $sql = "SELECT order_product.*, orders.*, product.product_name, product.subject_img FROM order_product 
    JOIN orders ON order_product.order_id = orders.id
    JOIN product ON order_product.product_id = product.id
    WHERE order_product.order_id = $order_product";

   
}else{
    $sql = "SELECT order_product.*, orders.*, product.product_name, product.subject_img FROM order_product 
    JOIN orders ON order_product.order_id = orders.id
    JOIN product ON order_product.product_id = product.id";
   
} 
$resultCll=$conn->query($sql); 
$productCount=$resultCll->num_rows;
$rowsCll=$resultCll->fetch_all(MYSQLI_ASSOC); 
//var_dump($rowsCll);


//-----會員訂單資訊----
$sql="SELECT orders.*, user.user_account, user.user_phone, user.user_address, coupon.* FROM orders
JOIN user ON orders.user_id = user.id
JOIN coupon ON orders.coupon_sn = coupon.sn
WHERE orders.id = '$id'
ORDER BY orders.id DESC  ";


$result = $conn->query($sql);
//$productCount=$result->num_rows;
$row=$result->fetch_assoc(); 
//var_dump($row);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>訂單詳細</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php')?>
    <link href="../../css/orders.css" rel="stylesheet">
</head>

<body id="page-top">
        <div id="wrapper" class="template_wrapper">
        <!-- sidebar -->
        <?php include(dirname(__FILE__) . '../../../link/sidebar.php')?>

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                <!-- nav -->
                    <?php include(dirname(__FILE__) . '../../../link/nav.php')?>

                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-11 mx-auto ">
                                <div class="d-flex justify-content-between">
                                    <div class="title">
                                            <h1 class="mb-3">訂單詳細</h1>
                                    </div>
                                    <div class="icon">
                                        <a class="btn text_btn" href="orders.php">
                                            <i class="fa-solid fa-arrow-left me-2"></i>
                                            <p>訂單管理</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="content shadow">
                                    <div class="row d-flex justify-content-between mb-2">
                                        <div class="col-md-5 d-flex align-items-center order-number">
                                            <!-- <h4>訂單編號 : <?=$row["id"]?></h4> -->
                                            <h4>訂單編號 : <?=$_GET["id"]?></h4>
                                        </div>
                                        <div class="col-md-4 text-end align-items-center order-address">
                                            <p>
                                            <?php if($row["take_method"]=="1"){
                                                            echo "寄送地址 :".$row["order_address"];
                                                        }else{
                                                            echo "自取地址 :桃園市中壢區新生路二段421號";
                                                        }
                                                    ?>
                                            
                                        </p>
                                        </div>
                                    </div>

                                    <!-- 會員 -->
                                    <table class="table mt-4 table_top">
                                        <thead>
                                            <tr>
                                                <th>訂購日期</th>
                                                <th>訂購者</th>
                                                <th>連絡電話</th>
                                                <th>取件方式</th>
                                                <th>付款方式</th>
                                                <th>付款狀態</th>
                                                <th>處理進度</th>
                                                <th>訂單狀態</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                <?=$row["order_create_time"]?>
                                            </td>
                                            <td>
                                                <?=$row["user_account"]?>
                                            </td>
                                            <td>
                                                <?=$row["order_phone"]?>
                                            </td>
                                            <td>
                                                <?php if($row["take_method"]=="1"){
                                                    echo "黑貓宅配";
                                                }else{
                                                        echo "自取";
                                                }
                                            ?>
                                            </td>
                                            <td>
                                            <?php if($row["pay_method"]=="1"){
                                                    echo "線上付款";
                                                }else{
                                                        echo "銀行轉帳";
                                                }
                                            ?>
                                            </td>
                                            <td>
                                            <?php if($row["pay_status"]=="1"){
                                                    echo "未付款";
                                                }else{
                                                    echo "已付款";
                                                }
                                            ?>
                                            </td>
                                            <td>
                                            <?php if($row["update_status"]=="1"){
                                                    echo "未出貨";
                                                }elseif($row["update_status"]=="2"){
                                                    echo "已出貨";
                                                }else{
                                                    echo "退/換貨";
                                                }
                                            ?>
                                            </td>
                                            <td>
                                            <?php if($row["order_status"]=="1"){
                                                    echo "未完成";
                                                }else{
                                                    echo "已完成";
                                                }
                                            ?>
                                            </td>
                                        </tbody>
                                    </table>


                                    <!-- 商品清單 -->
                                    <div class="row mt-5">
                                        <div class="table-left col-9">
                                            <div class="order_text">
                                                    <h4>購買商品清單</h4>
                                            </div>
                                            <table class="table mt-4">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>商品圖片</th>
                                                        <th>商品名稱</th>
                                                        <th>數量</th>
                                                        <th>單件價格</th>
                                                        <th>小計</th>
                                                    </tr>
                                                    
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total=0;
                                                    $totalAmount=0;
                                                    foreach ($rowsCll as $data) : ?>
                                                        <tr class="text-center">
                                                            <td>
                                                                <img class="max_height" src="../../upload/product-subject/<?=$data["subject_img"]?>" alt="">
                                                            </td>
                                                            <td>
                                                                <?=$data["product_name"]?>
                                                            </td>
                                                            <td>
                                                                <?=$data["order_amount"]?>
                                                            </td>
                                                            <td>
                                                                <?=$data["product_price"]?>
                                                            </td>
                                                            <td>
                                                                <?=$data["order_amount"]*$data["product_price"]?>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                        $total += $data["order_amount"]*$data["product_price"];
                                                        $totalAmount += $data["order_amount"];
                                                        ?>
                                                    <?php endforeach; ?>
                                               
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="table-right col-3">
                                            <div class="order_text">
                                                    <h4>商品金額</h4>
                                            </div>
                                            <div class=" mt-4 background">
                                                <div class="div">
                                                    <p>數量</p>
                                                    <p>小計</p>
                                                    <p class="text-primary">優惠代碼</p>
                                                    <p class="text-primary">優惠折扣</p>
                                                    <p>運費</p>
                                                    
                                                </div>
                                                <div class="text-end">
                                                    <p> <?php echo $totalAmount; ?> </p>
                                                    <p><?php echo $total;?></p>
                                                    <p class="text-primary"> <?=$row["sn"]?> </p>
                                                    <p class="text-primary"> <?=$row["discount"]?> </p>
                                                    <p> <?= $row["freight"]?> </p>
                                                    
                                                </div>
                                            </div>
                                            <div class="background_footer">
                                                <p class="total_amount">合計</p>
                                                <p class="total_amount text-end "> TWD
                                                    <?php
                                                        $total_amount=$total - $row["discount"] + $row["freight"] ;
                                                        echo ceil($total_amount);
                                                    ?> 
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="order-edit.php?id=<?= $data["id"] ?>" class="btn btn-primary">編輯</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>