<?php
require_once("../../music-db-connect.php");

// //連接product_category
$sql = "SELECT * FROM product_spec WHERE id ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$userCount = $result->num_rows;


if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$sqlAll = "SELECT * FROM product_spec WHERE id ";
$resultAll = $conn->query($sqlAll);

//每頁顯示數
$per_page = 5;

$page_start = ($page - 1) * $per_page;


$sql = "SELECT * FROM product_spec WHERE id  ORDER BY id   ASC LIMIT $page_start, $per_page";
$result = $conn->query($sql);


//計算總頁數
$totalPage = ceil($userCount / $per_page);


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
    <title>商品規格</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <link href="../../css/user.css" rel="stylesheet">
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
                        <div class="col-10 mx-auto user">
                            <h1 class="mb-4">商品規格</h1>

                            <div class="content shadow">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-3 py-2">共 <?= $userCount ?>種</div>

                                    <div class="col-3 text-end">
                                        <a class="btn btn-info" href="product-spec-add.php">
                                            <i class="fa-solid fa-plus"></i>規格
                                        </a>
                                    </div>
                                </div>

                                <table class="table table-hover mt-4">
                                    <thead>
                                        <tr>
                                            <th class="w-10">編號</th>
                                            <th>商品規格</th>
                                            <th>規格說明</th>
                                            <th class="text-cerent w-30">操作</th>
                                        </tr>
                                    </thead>
                                    <?php if ($userCount > 0) : ?>
                                        <tbody>

                                            <?php foreach ($result as $result) : ?>
                                                <tr>
                                                    <td><?= $result["id"] ?></td>
                                                    <td><?= $result["spec_name"] ?></td>
                                                    <td><?= $result["spec_description"] ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-primary me-3" href="product-spec-edit.php?id=<?= $result["id"] ?>">編輯</a>
                                                        <a class="btn btn-danger"  href="product-spec-delete.php?id=<?= $result["id"]?>">刪除</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    <?php endif; ?>
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                                    <nav aria-label="...">
                                        <ul class="pagination">

                                            <?php
                                            if ($page > 1) {
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="product-spec.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                </li>
                                            <?php
                                            } ?>

                                            <?php
                                            for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                <li class="page-item <?php if ($i == $page) echo "active"; ?>" aria-current="page">
                                                    <a class="page-link" href="product-spec.php?page=<?= $i ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>

                                            <?php
                                            if ($page < $totalPage) {
                                            ?>

                                                <li class="page-item">
                                                    <a class="page-link" href="product-spec.php?page=<?= $page + 1 ?>">></a>
                                                </li>
                                            <?php
                                            }
                                            $page = '';
                                            ?>

                                        </ul>
                                    </nav>

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