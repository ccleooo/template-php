<?php


require_once("../../music-db-connect.php");

$sql = "SELECT orders.*, user.user_account FROM orders
JOIN user ON orders.user_id = user.id
WHERE valid=1 ";

$result = $conn->query($sql);
$ordersCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);




//---------分頁 搜尋---------
if (isset($_GET["startDate"])) {
    $startDate = $_GET["startDate"];
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $per_page = 5; //一頁幾筆
    $page_start = ($page - 1) * $per_page;

    $sqlALL = "SELECT orders.*, user.user_account FROM orders
    JOIN user ON orders.user_id = user.id 
    WHERE orders.order_create_time='$startDate' AND valid=1 
    ORDER BY id DESC ";
    $resultALL = $conn->query($sqlALL);
    $ordersCount = $resultALL->num_rows;

    $sql = "SELECT orders.*, user.user_account FROM orders
    JOIN user ON orders.user_id = user.id 
    WHERE orders.order_create_time='$startDate' AND valid=1 
    ORDER BY id DESC LIMIT $page_start, $per_page";

    $totalPage = ceil($ordersCount / $per_page); //ceil() 無條件進位
    
} elseif (isset($_GET["search"])) {
    $search = $_GET["search"];
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $per_page = 5; //一頁幾筆
    $page_start = ($page - 1) * $per_page;

    $sqlBLL = "SELECT orders.*, user.user_account FROM orders
    JOIN user ON orders.user_id = user.id 
    WHERE user_account LIKE '%$search%'  AND valid=1 
    ORDER BY id DESC ";
    $resultBLL = $conn->query($sqlBLL);
    $ordersCount = $resultBLL->num_rows;

    $sql = "SELECT orders.*, user.user_account FROM orders
            JOIN user ON orders.user_id = user.id 
            WHERE user_account LIKE '%$search%'  AND valid=1 
            ORDER BY id DESC LIMIT $page_start, $per_page";
    
     $totalPage = ceil($ordersCount / $per_page); //ceil() 無條件進位

} else {
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
        $per_page = 5; //一頁幾筆
        $page_start = ($page - 1) * $per_page;

        $sqlDll = "SELECT orders.*, user.user_account FROM orders
        JOIN user ON orders.user_id = user.id";
         $resultDll = $conn->query($sqlDll);
         $ordersCountDll = $resultDll->num_rows;
        
        $sql = "SELECT orders.*, user.user_account FROM orders
            JOIN user ON orders.user_id = user.id
            WHERE valid=1 
            ORDER BY id DESC LIMIT $page_start, $per_page ";
        $totalPage = ceil($ordersCount / $per_page); //ceil() 無條件進位


    } 


$result = $conn->query($sql);
$ordersCount = $result->num_rows;

$rows = $result->fetch_all(MYSQLI_ASSOC);


//    var_dump($rows)


?>


<!doctype html>
<html lang="en">

</head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Orders</title>
<?php include(dirname(__FILE__) . '../../../link/header.php')?>
<link href="../../css/orders.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper" class="template_wrapper">
        <!-- sidebar -->
        <?php include(dirname(__FILE__) . '../../../link/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- nav -->
                <?php include(dirname(__FILE__) . '../../../link/nav.php') ?>

                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-11 mx-auto ">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                        <h1 class="mb-3">訂單管理</h1>
                                </div>
                                <?php if (isset($_GET["startDate"]) || isset($_GET["search"])) : ?>
                                    <div class="icon">
                                        <a class="btn text_btn" href="orders.php">
                                            <i class="fa-solid fa-arrow-left me-2"></i>
                                            <p>訂單管理</p>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>


                            <!-- 篩選 -->
                            <div class="content shadow">
                                <div class="row d-flex justify-content-between mb-2">
                                    <div class="col-md-6 d-flex align-items-center ">
                                        <p class="pe-2">訂單日期 </p>
                                        <form action="orders.php" method="get">
                                            <div class="row g-2 align-items-center ">
                                                <div class="col-auto">
                                                    <input type="date" class="form-control" id="startDate" name="startDate" value="<?php if (isset($_GET["startDate"])) echo $_GET["startDate"]; ?>">
                                                </div>
                                                <div class="col-auto">
                                                    <button class="btn btn-primary ">
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="col-md-4 d-flex align-items-center justify-content-end col-auto">
                                        <form action="orders.php" method="get">
                                            <div class="input-group">
                                                <input type="search" class="form-control" name="search">
                                                <button type="submit" class="btn btn-primary btn_search">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?php if (isset($_GET["search"])) : ?>
                                            <div class=" mt-3 ">
                                                <h1>
                                                    <?php
                                                    if ($_GET["search"] == "1") {
                                                        echo "訂單未完成";
                                                    } elseif ($_GET["search"] == "2") {
                                                        echo "訂單已完成";
                                                    } else {
                                                        echo $_GET["search"];
                                                    }
                                                    ?>
                                                    的搜尋結果</h1>
                                            </div>
                                            <div class="py-2">
                                                共 <?= $ordersCount ?> 項
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- table -->
                                <div class="table">
                                    <table class="table mt-4 table-hover">
                                        <thead>
                                            <tr>
                                                <th>訂單編號</th>
                                                <th>訂購者</th>
                                                <th>下單時間</th>
                                                <th>付款方式</th>
                                                <th>取件方式</th>
                                                <th>付款狀態</th>
                                                <th>處理進度</th>
                                                <th>訂單狀態</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <?php if ($rows > 0) : ?>
                                            <tbody>
                                                <?php foreach ($rows as $data) : ?>
                                                    <tr>
                                                        <td>
                                                            <?= $data["id"] ?>
                                                        </td>
                                                        <td>
                                                            <?= $data["user_account"] ?>
                                                        </td>
                                                        <td>
                                                            <?= $data["order_create_time"] ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($data["pay_method"] == "1") {
                                                                echo "線上付款";
                                                            } else {
                                                                echo "銀行轉帳";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($data["take_method"] == "1") {
                                                                echo "黑貓宅配";
                                                            } else {
                                                                echo "自取";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($data["pay_status"] == "1") {
                                                                echo "未付款";
                                                            } else {
                                                                echo "已付款";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($data["update_status"] == "1") {
                                                                echo "未出貨";
                                                            } elseif ($data["update_status"] == "2") {
                                                                echo "已出貨";
                                                            } else {
                                                                echo "退/換貨";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($data["order_status"] == "1") {
                                                                echo "未完成";
                                                            } else {
                                                                echo "已完成";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="order-detial.php?id=<?= $data["id"] ?>" class="btn btn-primary">檢視</a>
                                                            
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                        <?php endif ?>
                                    </table>


                                    <!-- 分頁 -->
                                    <div class="d-flex justify-content-center mt-4">
                                        <?php if ( isset($_GET["startDate"])) : ?>
                                            <nav aria-label="...">
                                                <ul class="pagination">
                                                    <?php if ($page > 1) { ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="orders.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                        </li>
                                                    <?php } ?>

                                                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                        <li class="page-item 
                                                        <?php if ($i == $page) echo "active"; ?>" aria-current="page">
                                                            <a class="page-link" href="orders.php?page=<?= $i ?>&startDate=<?= $startDate ?>">
                                                                <?= $i ?>
                                                            </a>
                                                        </li>
                                                    <?php endfor; ?>

                                                    <?php if ($page < $totalPage) { ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="orders.php?page=<?= $page + 1 ?>">></a>
                                                        </li>
                                                    <?php  } $page = ''; ?>
                                                </ul>
                                            </nav>
                                            <?php elseif ( isset($_GET["search"])) : ?>
                                                <nav aria-label="...">
                                                    <ul class="pagination">
                                                        
                                                        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                        <li class="page-item 
                                                        <?php if ($i == $page ) echo "active"; ?>" aria-current="page">
                                                            <a class="page-link" href="orders.php?page=<?= $i ?>&search=<?= $search ?>">
                                                                <?= $i ?>
                                                            </a>
                                                        </li>
                                                    <?php endfor; ?>
                                                </nav>
                                            <?php else: ?>
                                                <nav aria-label="...">
                                                    <ul class="pagination">
                                                        <?php if ($page > 1) { ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="orders.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                            </li>
                                                        <?php } ?>

                                                        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                            <li class="page-item 
                                                            <?php if ($i == $page ) echo "active"; ?>" aria-current="page">
                                                                <a class="page-link" href="orders.php?page=<?= $i ?>">
                                                                    <?= $i ?>
                                                                </a>
                                                            </li>
                                                        <?php endfor; ?>

                                                    <?php if ($page < $totalPage) { ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="orders.php?page=<?= $page + 1 ?>">></a>
                                                        </li>
                                                    <?php  } $page = ''; ?>
                                                </nav>
                                        <?php endif; ?>
                                    </div>
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
    <?php include(dirname(__FILE__) . '../../..//link/js.php')?>

</body>

</html>
