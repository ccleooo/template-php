<?php
require_once("../../music-db-connect.php");


if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$per_page = 5;
$page_start = ($page - 1) * $per_page;


if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM coupon WHERE sn LIKE '%$search%' AND valid=1 ";
    $result = $conn->query($sql);
    $snCount = $result->num_rows;
    $rows = $result->fetch_all(MYSQLI_ASSOC);
} else {

    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $sqlAll = "SELECT * FROM coupon WHERE valid=1";
    $result = $conn->query($sqlAll);
    $snCount = $result->num_rows;


    $per_page = 5;
    $page_start = ($page - 1) * $per_page;

    // $sql="SELECT * FROM users WHERE valid=1 ORDER BY created_at DESC LIMIT 5,5";//從第5筆開始抓5筆
    $sql = "SELECT * FROM coupon WHERE valid=1 ORDER BY create_time DESC LIMIT $page_start,$per_page";
    $result = $conn->query($sql);

    //計算頁數
    $totalPage = ceil($snCount / $per_page);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}



if (isset($_GET["startDate"])) {

    $start = $_GET["startDate"];
    $end = $_GET["endDate"];
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $per_page = 5;
    $page_start = ($page - 1) * $per_page;


    $sqlBll = "SELECT * FROM coupon WHERE start_time BETWEEN '$start' AND '$end' ORDER BY create_time DESC";
    $resultBll = $conn->query($sqlBll);
    $snCount = $resultBll->num_rows;


    $sql = "SELECT * FROM coupon WHERE start_time BETWEEN '$start' AND '$end' ORDER BY create_time DESC LIMIT $page_start,$per_page";

    // $result = $conn->query($sql);
    // // var_dump($result);
    // $snCount = $result->num_rows;
    // // var_dump($snCount);


    $totalPage = ceil($snCount / $per_page);
    // var_dump($totalPage);

}
$result = $conn->query($sql);
// var_dump($result);
$snCount = $result->num_rows;
// var_dump($snCount);
$rows = $result->fetch_all(MYSQLI_ASSOC);






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>優惠管理</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper" class="template_wrapper">
        <!-- sidebar -->
        <?php include(dirname(__FILE__) . '../../../link/sidebar.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- nav -->
                <?php include(dirname(__FILE__) . '../../../link/nav.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-11 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <h1 class="mb-4">優惠管理</h1>
                                <?php if (!isset($_GET["startDate"])) : ?>

                                <?php else : ?>
                                    <div class="icon">
                                        <a class="btn text_btn" href="coupon.php">
                                            <i class="fa-solid fa-arrow-left me-2"></i>
                                            <p>優惠管理</p>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="content shadow">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-6 d-flex align-items-center order-number ps-4">
                                        <p class=" date px-2">活動日期 </p>
                                        <form action="">
                                            <div class="row g-2 align-items-center">
                                                <div class="col-auto">
                                                    <input type="date" class="form-control" name="startDate" value="<?php if (isset($_GET["startDate"])) echo $_GET["startDate"]; ?>">
                                                </div>
                                                <div class="col-auto">
                                                    to
                                                </div>
                                                <div class="col-auto">
                                                    <input type="date" class="form-control" name="endDate" value="<?php if (isset($_GET["endDate"])) echo $_GET["endDate"]; ?>">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>   
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <div class="py-2">
                                            <form action="coupon.php" method="get">
                                                <div class="input-group">
                                                    <input type="text" class="form-control " name="search">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-sm"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="py-2 ms-5">
                                            <a class="btn btn-info" href="coupon-add.php">
                                                <i class="fa-solid fa-plus"></i>
                                                coupon
                                            </a>
                                        </div>
                                    </div>
                                    <?php if (isset($_GET["search"])) : ?>
                                        <div class=" mt-3 ms-4 d-flex justify-content-between">
                                            <h1><?= $_GET["search"] ?>的搜尋結果</h1>
                                        </div>
                                    <?php endif; ?>
                                    <table class="table mt-4 table-hover">
                                        <thead>
                                            <tr>
                                                <th class="w-15">序號</th>
                                                <th>優惠名稱</th>
                                                <th>折扣金額</th>
                                                <th>數量</th>
                                                <th class="w-15">開始時間</th>
                                                <th class="w-15">結束時間</th>
                                                <th>創建時間</th>
                                                <th>操作</th>

                                            </tr>
                                        </thead>
                                        <?php if ($snCount > 0) : ?>
                                            <tbody>
                                                <?php foreach ($rows as $row) : ?>
                                                    <tr>
                                                        <td><?= $row["sn"] ?></td>
                                                        <td><?= $row["coupon_name"] ?></td>
                                                        <td><?= $row["discount"] ?></td>
                                                        <td><?= $row["quota"] ?></td>
                                                        <td><?= $row["start_time"] ?></td>
                                                        <td><?= $row["end_time"] ?></td>
                                                        <td><?= $row["create_time"] ?></td>


                                                        <td>
                                                            <a class="btn btn-primary me-3" href="coupon-edit.php?id=<?= $row["sn"] ?>">編輯</a>
                                                            <a class="btn btn-danger" href="coupon-doDelete.php?id=<?= $row["sn"] ?>">刪除</butt>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php endif; ?>
                                    </table>
                                    <div class="d-flex justify-content-center mt-4">
                                        <?php if (!isset($_GET["search"])) : ?>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <?php if ($page > 1) { ?>
                                                        <li class="page-item">
                                                            <?php if (isset($start)) { ?>
                                                                <a class="page-link" href="coupon.php?page=<?= $page - 1 ?>&startDate=<?=$start?>&endDate=<?=$end?>" aria-disabled="true"><</a>
                                                            <?php } else { ?>
                                                                <a class="page-link" href="coupon.php?page=<?= $page - 1 ?>"><</a>
                                                            <?php } ?>
                                                       </li>
                                                    <?php } ?>

                                                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                        <li class="page-item <?php if ($i == $page) echo "active"; ?>">
                                                            <a class="page-link" href=<?php if (isset($start)) echo "coupon.php?page=$i&startDate=$start&endDate=$end" ?> 
                                                            <?php if (!isset($start)) echo "coupon.php?page=$i" ?>><?= $i ?>
                                                            </a>
                                                        </li>
                                                    <?php endfor; ?>

                                                    <?php if ($page < $totalPage) { ?>
                                                        <li class="page-item">
                                                            <?php if (isset($start)) { ?>
                                                                <a class="page-link" href="coupon.php?page=<?= $page + 1 ?>&startDate=<?=$start?>&endDate=<?=$end?>" aria-disabled="true">></a>
                                                            <?php } else { ?>
                                                                <a class="page-link" href="coupon.php?page=<?= $page + 1 ?>">></a>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } $page = ''; ?>
                                                </ul>
                                            </nav>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->


        <!-- js -->
        <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>