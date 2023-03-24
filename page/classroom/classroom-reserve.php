<?php
require_once("../../music-db-connect.php");


$sql = "SELECT classroom_reserve.*, classroom.classroom_name, classroom.reserve_price, user.user_account  FROM classroom_reserve
    JOIN user ON classroom_reserve.user_id = user.id
    JOIN classroom ON classroom_reserve.classroom_id = classroom.id";

$result = $conn->query($sql);
$reserveCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
// JOIN語法 SELECT A.*, B.* FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)
// -----------------------------------------------------

if (isset($_GET["startDate"])) {
    $startDate = $_GET["startDate"];
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $per_page = 5; //一頁幾筆
    $page_start = ($page - 1) * $per_page;
   

    $sqlALL = "SELECT classroom_reserve.*, classroom.classroom_name, classroom.reserve_price, user.user_account  FROM classroom_reserve
    JOIN user ON classroom_reserve.user_id = user.id
    JOIN classroom ON classroom_reserve.classroom_id = classroom.id
    WHERE classroom_reserve.reserve_date='$startDate' AND Class_order_valid=1 
    ORDER BY classroom_reserve.id DESC";

    $resultALL = $conn->query($sqlALL);
    $DateCount = $resultALL->num_rows;

    $sql = "SELECT classroom_reserve.*, classroom.classroom_name, classroom.reserve_price, user.user_account  FROM classroom_reserve
    JOIN user ON classroom_reserve.user_id = user.id
    JOIN classroom ON classroom_reserve.classroom_id = classroom.id
    WHERE classroom_reserve.reserve_date='$startDate' AND Class_order_valid=1 
    ORDER BY classroom_reserve.id DESC LIMIT $page_start, $per_page";

    $totalPage = ceil($DateCount / $per_page); //ceil() 無條件進位

}else {
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
        $per_page = 5; //一頁幾筆
        $page_start = ($page - 1) * $per_page;

        $sql = "SELECT classroom_reserve.*, classroom.classroom_name, classroom.reserve_price, user.user_account  FROM classroom_reserve
        JOIN user ON classroom_reserve.user_id = user.id
        JOIN classroom ON classroom_reserve.classroom_id = classroom.id
        WHERE Class_order_valid=1";
         $result = $conn->query($sql);
         $Count = $result->num_rows;
        
         $sql = "SELECT classroom_reserve.*, classroom.classroom_name, classroom.reserve_price, user.user_account  FROM classroom_reserve
         JOIN user ON classroom_reserve.user_id = user.id
         JOIN classroom ON classroom_reserve.classroom_id = classroom.id
         WHERE Class_order_valid=1
        ORDER BY id DESC LIMIT $page_start, $per_page ";
        $totalPage = ceil($Count / $per_page); //ceil() 無條件進位
    } 
    $result = $conn->query($sql);
    $reserveCount = $result->num_rows;
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
    <title>class-reserve</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php')?>

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
                        <div class="col-11 mx-auto ">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">教室預約</h1>
                                </div>
                                <?php if (isset($_GET["startDate"])) : ?>
                                <div class="icon">
                                    <a class="btn text_btn" href="classroom-reserve.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>教室預約</p>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="content shadow">
                                <div class="col-auto align-items-center">
                                    <div class="py-2 d-flex align-items-center justify-content-between ">
                                        <form action="classroom-reserve.php" method="get">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <input type="date" class="form-control" name="startDate" value="<?php if (isset($_GET["startDate"])) echo $_GET["startDate"]; ?>">
                                                </div>
                                                <div class="col-auto">
                                                    <button class="btn btn-primary"> 確定</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                    <table class="table table-hover mt-4">
                                        <thead>
                                            <tr>
                                                <th>教室訂單編號</th>
                                                <th>會員</th>
                                                <th>教室</th>
                                                <th>價錢</th>
                                                <th>預約日期</th>
                                                <th>預約時間</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <?php if ($rows > 0) : ?>
                                            <tbody>
                                                <?php foreach ($rows as $data) : ?>
                                                    <tr>
                                                        <td><?= $data["id"] ?></td>
                                                        <td><?= $data["user_account"] ?></td>
                                                        <td><?= $data["classroom_name"] ?></td>
                                                        <td>$<?= $data["reserve_price"] ?> / 3hr</td>
                                                        <td><?= $data["reserve_date"] ?></td>
                                                        <td><?= $data["reserve_time"] ?></td>
                                                        <td>
                                                            <a class="btn btn-primary me-3" href="classroom-reserve-edit.php?id=<?= $data["id"] ?>">編輯</a>
                                                            <a class="btn btn-danger" href="classroom-reserve-delete.php?id=<?= $data["id"] ?>">刪除</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php endif ?>
                                    </table>

                                    <div class="d-flex justify-content-center mt-4">
                                    <?php if (!isset($_GET["startDate"])) : ?>
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <?php if ($page > 1) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="classroom-reserve.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                    </li>
                                                <?php } ?>

                                                <?php
                                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $page) echo "active"; ?>" aria-current="page">
                                                        <a class="page-link" href="classroom-reserve.php?page=<?= $i ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($page < $totalPage) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="classroom-reserve.php?page=<?= $page + 1 ?>">></a>
                                                    </li>
                                                <?php }
                                                $page = ''; ?>
                                            </ul>
                                        </nav>
                                    <?php else : ?>
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <?php if ($page > 1) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="classroom-reserve.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                    </li>
                                                <?php } ?>

                                                <?php
                                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $page) echo "active"; ?>" aria-current="page">
                                                        <a class="page-link" href="classroom-reserve.php?page=<?= $i ?>&startDate=<?= $startDate ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($page < $totalPage) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="classroom-reserve.php?page=<?= $page + 1 ?>">></a>
                                                    </li>
                                                <?php }
                                                $page = ''; ?>
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