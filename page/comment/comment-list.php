<?php
require_once("../../music-db-connect.php");

//判斷篩選有無成立
if (isset($_GET["category"])) {
    $A = $_GET["category"];
} else {
    $A = "0";
}
if ($A != "0") {
    $whsql = "WHERE user.id ='" . $_GET["category"] . "'";
} else {
    $whsql = "";
}
//JOIN語法 SELECT A.*, B.b FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)
$sql = "SELECT comment.*, user.user_account, product.product_name FROM comment
JOIN user ON comment.user_id = user.id
JOIN product ON comment.product_id = product.id
  " . $whsql . "
  ";

$result = $conn->query($sql);
$articlerows = $result->fetch_all(MYSQLI_ASSOC);

$productCount = $result->num_rows;
//判斷當前頁
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

//叫出產品所有資料
$sqlAll = "SELECT * FROM comment";
$resultAll = $conn->query($sqlAll);

//每頁顯示數
$per_page = 10;

//運算頁面起始值
$page_start = ($page - 1) * $per_page;

//計算總頁數
$totalPage = ceil($productCount / $per_page);

//輸出
$rows = $result->fetch_all(MYSQLI_ASSOC);





$sql = "SELECT comment.*, user.user_account, product.product_name FROM comment
JOIN user ON comment.user_id = user.id
JOIN product ON comment.product_id = product.id
ORDER BY id DESC ";

//JOIN語法 SELECT A.*, B.* FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)
$result = $conn->query($sql);
$productCount = $result->num_rows;
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
    <title>Comment List</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <link href="../../css/comment.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- sidebar -->
        <?php include(dirname(__FILE__) . '../../../link/sidebar.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- nav -->
                <?php include(dirname(__FILE__) . '../../../link/nav.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-11 mx-auto ">
                            <div class="">
                                <h1 class="mb-4">評論一覽</h1>
                            </div>
                            <?php
                            //計算頁面啟始結束值

                            //JOIN語法 SELECT A.*, B.b FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)
                            $sql = "SELECT comment.*, user.user_account FROM comment JOIN user ON comment.user_id = user.id " . $whsql . "ORDER BY id ASC LIMIT $page_start, $per_page ";
                            $result = $conn->query($sql);

                            ?>
                            <div class="content shadow">
                                <div class="py-2 d-flex justify-content-end">
                                    <a class="btn btn-info" href="comment-add.php">
                                        <i class="fa-solid fa-plus"></i>
                                        新增評論
                                    </a>
                                </div>
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>編號</th>
                                            <th>會員</th>
                                            <th class="w-30">商品</th>
                                            <th class="w-30">評論</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows as $row) : ?>
                                            <tr>
                                                <td>
                                                    <?= $row["id"] ?>
                                                </td>
                                                <td>
                                                    <?= $row["user_account"] ?>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?= $row["product_name"] ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="multiline_ellipsis">
                                                        <?= $row["comment"] ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" href="comment-detail.php?id=<?= $row["id"] ?>">檢視</a>
                                                    <a class="btn btn-danger delete-confirm" href="comment-delete.php?id=<?= $row["id"] ?>">刪除</ㄇ>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                                    <?php if (!isset($_GET["$A"])) : ?>
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <?php if ($page > 1) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="comment-list.php?page=<?= $page - 1 ?>" aria-disabled="true">
                                                            <</a>
                                                    </li>
                                                <?php } ?>

                                                <?php
                                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item 
                                                <?php if ($i == $page || $A == $category) echo "active"; ?>" aria-current="page">
                                                        <a class="page-link" href="comment-list.php?page=<?= $i ?>&category=<?= $A ?>"><?= $i ?><? $A ?>
                                                        </a>

                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($page < $totalPage) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="comment-list.php?page=<?= $page + 1 ?>">></a>
                                                    </li>
                                                <?php  }
                                                $page = ''; ?>
                                            </ul>
                                        </nav>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- content -->
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