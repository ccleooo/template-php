<?php
require_once("../../music-db-connect.php");

$sql = "SELECT class_order.*, user.user_account, user.user_phone, class.class_name FROM class_order
JOIN user ON class_order.user_id = user.id 
JOIN class ON class_order.class_id  = class.id";

$result = $conn->query($sql);
$orderCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
//var_dump($rows);

// ------------------------------------------------------------

if (isset($_GET["startDate"])) {
    $startDate = $_GET["startDate"];
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $per_page = 5; //一頁幾筆
    $page_start = ($page - 1) * $per_page;

    //符合日期的條件全部抓出來
    $sqlALL = "SELECT class_order.*, class.class_name, user.user_account, user.user_phone  FROM class_order
    JOIN user ON class_order.user_id = user.id
    JOIN class ON class_order.class_id = class.id
    WHERE class_order.create_time='$startDate' AND class_order_valid=1 
    ORDER BY class_order.id DESC";
    //JOIN語法 SELECT A.*, B.* FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)

    $resultALL = $conn->query($sqlALL);
    $DateCount = $resultALL->num_rows;

    //篩選一頁留幾筆
    $sql = "SELECT class_order.*, class.class_name, user.user_account, user.user_phone  FROM class_order
    JOIN user ON class_order.user_id = user.id
    JOIN class ON class_order.class_id = class.id
    WHERE class_order.create_time='$startDate' AND class_order_valid=1 
    ORDER BY class_order.id DESC LIMIT $page_start, $per_page";

    $totalPage = ceil($DateCount / $per_page); //ceil() 無條件進位


} else {
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $per_page = 5; //一頁幾筆
    $page_start = ($page - 1) * $per_page;

    $sql = "SELECT class_order.*, class.class_name, user.user_account, user.user_phone  FROM class_order
        JOIN user ON class_order.user_id = user.id
        JOIN class ON class_order.class_id = class.id
        WHERE class_order_valid=1 ";
    $result = $conn->query($sql);
    $Count = $result->num_rows;

    $sql = "SELECT class_order.*, class.class_name, user.user_account, user.user_phone  FROM class_order
        JOIN user ON class_order.user_id = user.id
        JOIN class ON class_order.class_id = class.id
        WHERE class_order_valid=1 
        ORDER BY id DESC LIMIT $page_start, $per_page ";
    $totalPage = ceil($Count / $per_page); //ceil() 無條件進位

}
$result = $conn->query($sql);
$orderCount = $result->num_rows;
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
    <title>class-order</title>
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
                        <div class="col-11 mx-auto ">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">課程訂單</h1>
                                </div>
                                <?php if (isset($_GET["startDate"])) : ?>
                                <div class="icon">
                                    <a class="btn text_btn" href="class-order.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>課程訂單</p>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="content shadow">
                                <div class="col-auto align-items-center">
                                    <div class="py-2 d-flex align-items-center justify-content-between ">
                                        <form action="class-order.php" method="get">
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
                                <table class="table table-hover jmt-4">
                                    <thead>
                                        <tr>
                                            <th>訂單編號</th>
                                            <th>會員</th>
                                            <th>電話</th>
                                            <th>課程</th>
                                            <th>價錢</th>
                                            <th>下單時間</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($rows as $data) : ?>
                                            <tr>
                                                <td><?= $data["id"] ?></td>
                                                <td><?= $data["user_account"] ?></td>
                                                <td><?= $data["order_phone"] ?></td>
                                                <td><?= $data["class_name"] ?></td>
                                                <td><?= $data["order_price"] ?></td>
                                                <td><?= $data["create_time"] ?></td>
                                                <td>
                                                    <a class="btn btn-primary me-3" href="class-order-edit.php?id=<?= $data["id"] ?>">編輯</a>
                                                    <a class="btn btn-danger" href="class-order-delete.php?id=<?= $data["id"] ?>">刪除</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>

                                <div class="d-flex justify-content-center mt-4">
                                    <?php if (!isset($_GET["startDate"])) : ?>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                            <?php if ($page > 1) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="class-order.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                    </li>
                                                <?php } ?>

                                                <?php
                                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $page) echo "active"; ?>" aria-current="page">
                                                        <a class="page-link" href="class-order.php?page=<?= $i ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($page < $totalPage) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="class-order.php?page=<?= $page + 1 ?>">></a>
                                                    </li>
                                                <?php  } $page = ''; ?>
                                            </ul>
                                        </nav>
                                    <?php else : ?>

                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                            <?php if ($page > 1) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="class-order.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                    </li>
                                                <?php } ?>

                                                <?php
                                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $page) echo "active"; ?>" aria-current="page">
                                                        <a class="page-link" href="class-order.php?page=<?= $i ?>&startDate=<?= $startDate ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($page < $totalPage) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="class-order.php?page=<?= $page + 1 ?>">></a>
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