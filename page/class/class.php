<?php
require_once("../../music-db-connect.php");

$sql = "SELECT * FROM class";
$result = $conn->query($sql);
$class_nameCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_GET["search"])) { //有無get的search會影響到query結果
    $search = $_GET["search"];
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $per_page = 5; //一頁幾筆
    $page_start = ($page - 1) * $per_page;

    $sqlBLL = "SELECT * FROM class 
    WHERE class_name LIKE '%$search%'  AND class_valid=1 
    ORDER BY id DESC ";
    $resultBLL = $conn->query($sqlBLL);
    $classCount = $resultBLL->num_rows;

    $sql = "SELECT * FROM class 
    WHERE class_name LIKE '%$search%' AND class_valid=1
    ORDER BY id DESC LIMIT $page_start, $per_page"; //AND交集

    $totalPage = ceil($classCount / $per_page); //ceil() 無條件進位


} else {
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1; //預設$page=1
    }

    //計算總使用者
    $sqlAll = "SELECT * FROM class WHERE class_valid=1";
    $resultAll = $conn->query($sqlAll);
    $class_nameCount = $resultAll->num_rows;

    $per_page = 5;
    // $page=1;
    $page_start = ($page - 1) * $per_page;

    $sql = "SELECT * FROM class 
  WHERE class_valid=1 
  ORDER BY id DESC LIMIT $page_start, $per_page";

    $result = $conn->query($sql);


    //計算頁數: 總比數/每頁5筆 並 無條件進位
    $totalPage = ceil($class_nameCount / $per_page);
}

$result = $conn->query($sql);
$class_nameCount = $result->num_rows;

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
    <title>class</title>
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
                                <div class="title">
                                    <h1 class="mb-3">課程資訊</h1>
                                </div>
                                <?php if (isset($_GET["search"])) : ?>
                                    <div class="icon">
                                        <a class="btn text_btn" href="class.php">
                                            <i class="fa-solid fa-arrow-left me-2"></i>
                                            <p>課程列表</p>
                                        </a>
                                        </div>
                                <?php endif; ?>
                            </div>
                            <div class="content shadow">
                                <div class="row ">
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="col-3">
                                            <form action="class.php" method="get">
                                                <div class="input-group">
                                                    <input type="text" name="search" class="form-control">
                                                    <button type="submit" class="btn btn-primary btn_search"><i class="fas fa-search fa-sm"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-3 text-end">
                                            <a href="class-add.php" class="btn btn-info margin">
                                            <i class="fa-solid fa-plus"></i>
                                                課程新增
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php if (isset($_GET["search"])) : ?>
                                        <h1><?= $_GET["search"] ?>的搜尋結果</h1>
                                    <?php endif; ?>
                                </div>
                                <table class="table mt-4 table-hover">
                                    <thead>
                                        <tr>
                                            <th>課程編號</th>
                                            <th>課程名稱</th>
                                            <th>課程價格</th>
                                            <th>課程圖片</th>
                                            <th>開始日期</th>
                                            <th>結束日期</th>
                                            <th>老師</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <?php if ($class_nameCount > 0) : ?>
                                        <tbody>
                                            <?php foreach ($rows as $row) : ?>
                                                <tr>
                                                    <td><?= $row["id"] ?></td>
                                                    <td><?= $row["class_name"] ?></td>
                                                    <td><?= $row["class_price"] ?></td>
                                                    <td>
                                                        <img class="max_height" src="../../upload/class/<?=$row["class_img"]?>" alt="">
                                                    </td>
                                                    <td><?= $row["start_date"] ?></td>
                                                    <td><?= $row["end_date"] ?></td>
                                                    <td><?= $row["course_name"] ?></td>
                                                    <td>
                                                        <a class="btn btn-primary me-3" href="class-detail.php?id=<?= $row["id"] ?>">檢視</a>
                                                        <a class="btn btn-danger" href="class-delete.php?id=<?= $row["id"] ?>">刪除</a>
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
                                                        <a class="page-link" href="class.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                    </li>
                                                <?php } ?>

                                                <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $page) echo "active"; ?>">
                                                        <a class="page-link" href="class.php?page=<?= $i ?>">
                                                            <?= $i ?>
                                                        </a>
                                                    </li>
                                                <?php endfor; ?>    
                                                
                                                <?php if ($page < $totalPage) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="class.php?page=<?= $page + 1 ?>">></a>
                                                    </li>
                                                <?php  } $page = ''; ?>
                                            </ul>
                                        </nav>
                                    <?php else : ?>
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <?php if ($page > 1) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="class.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                    </li>
                                                <?php } ?>

                                                <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $page) echo "active"; ?>" aria-current="page">
                                                        <a class="page-link" href="class.php?page=<?= $i ?>&startDate=<?= $search ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($page < $totalPage) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="class.php?page=<?= $page + 1 ?>">></a>
                                                    </li>
                                                <?php  } $page = ''; ?>
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