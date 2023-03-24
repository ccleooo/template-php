<?php
require_once("../../music-db-connect.php");

// --------------------------------//

//判斷篩選有無成立
if (isset($_GET["user_level"])) {
    $A = $_GET["user_level"];
} else {
    $A = "0";
}
if ($A != "0") {
    $whsql = "WHERE user_level.id='" . $_GET["user_level"] . "AND user.user_valid=1'";
} else {
    $whsql = "";
}

//抓取分類
$sqlCategory = "SELECT * FROM user_level ORDER BY id ASC ";
$resultCategory = $conn->query($sqlCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);


if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1; //預設$page=1
}

//計算總有效的使用者
$sqlAll = "SELECT * FROM user WHERE user_valid=1";
//如果存在分類，需抓取分類所有效的使用者
if (isset($_GET["user_level"])) {
    $categoryId = $_GET["user_level"];
    $sqlAll = "SELECT user.*, user_level.level_name FROM user JOIN user_level ON user.user_level_id = user_level.id WHERE user_valid=1 AND user_level_id = " . $_GET["user_level"] . " ORDER BY create_time ASC";
}
$resultAll = $conn->query($sqlAll);
$userCount = $resultAll->num_rows;



// $sqlDesc =  "SELECT * FROM user WHERE user_valid=1 ORDER BY id DESC";

//取得分頁資料
$per_page = 5;
$page_start = ($page - 1) * $per_page;
if (isset($_GET["user_level"])) {
    $sql = "SELECT user.*, user_level.level_name FROM user JOIN user_level ON user.user_level_id = user_level.id WHERE user_valid=1 AND user_level_id = " . $_GET["user_level"] . " ORDER BY create_time ASC LIMIT $page_start, $per_page";
} else {
    $sql = "SELECT user.*, user_level.level_name FROM user JOIN user_level ON user.user_level_id = user_level.id WHERE user_valid=1 ORDER BY create_time ASC LIMIT $page_start, $per_page";
}

$result = $conn->query($sql);
//計算頁數: 總比數/每頁5筆 並 無條件進位
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
    <title>會員管理</title>
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
                        <div class="col-11 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">會員管理</h1>
                                </div>
                                <?php if (isset($_GET["user_level"])) : ?>
                                    <div class="icon">
                                        <a class="btn text_btn" href="user.php">
                                            <i class="fa-solid fa-arrow-left me-2"></i>
                                            <p>會員管理</p>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="content shadow">
                                <div class="row d-flex justify-content-between">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <form name="myForm" class="d-flex align-items-center">
                                            <p class="col-auto">會員篩選</p>
                                            <?php
                                            $categorysql = "SELECT * FROM user_level ORDER BY id ";
                                            $csql = $conn->query($categorysql);
                                            ?>
                                            <select class="form-select" name="category" id="category" class="text-input" style="height:auto;max-width:60%" onChange="location.replace('user.php?user_level='+this.options[this.selectedIndex].value);">
                                                <option value="0" selected>請選擇</option>
                                                <?php foreach ($csql as $csql) : ?>
                                                    <option value="<?= $csql["id"] ?>" 
                                                        <?php if ($A == $csql["id"]) { echo "selected";} ?>><?= $csql["level_name"] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                        <div class="col-md-4 text-end">
                                            <a href="user-add.php" class="btn btn-info">
                                                <i class="fa-solid fa-plus"></i>
                                                新增會員
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover mt-4">
                                    <thead>
                                        <tr>
                                            <th>編號</th>
                                            <th>等級</th>
                                            <th>帳號</th>
                                            <th>姓名</th>
                                            <th>生日</th>
                                            <th>Email</th>
                                            <th>電話</th>
                                            <th>建立時間</th>
                                            <th class="text-center">操作</th>
                                        </tr>
                                    </thead>
                                    <?php if ($userCount > 0) : ?>
                                        <tbody>
                                            <?php foreach ($rows as $row) : ?>
                                                <tr>
                                                    <td><?= $row["id"] ?></td>
                                                    <td><a href="user.php?user_level=<?= $row["user_level_id"] ?>"><?= $row["level_name"] ?></a></td>
                                                    <td><?= $row["user_account"] ?></td>
                                                    <td><?= $row["user_name"] ?></td>
                                                    <td><?= $row["user_birthday"] ?></td>
                                                    <td><?= $row["user_mail"] ?></td>
                                                    <td><?= $row["user_phone"] ?></td>
                                                    <td><?= $row["create_time"] ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-primary me-2" href="user-detail.php?id=<?= $row["id"] ?>">檢視</a>
                                                        <a class="btn btn-danger me-2" href="user-delete.php?id=<?= $row["id"] ?>">刪除</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    <?php endif; ?>
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <?php if ($page > 1) { ?>
                                                <li class="page-item">
                                                    <?php if (isset($categoryId)) { ?>
                                                        <a class="page-link" href="user.php?page=<?= $page - 1 ?>&user_level=<?= $categoryId ?>" aria-disabled="true"><</a>
                                                            <?php } else { ?>
                                                        <a class="page-link" href="user.php?page=<?= $page - 1 ?>"><</a>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>

                                            <?php
                                            for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                <li class="page-item 
                                                <?php if ($i == $page) echo "active"; ?>" aria-current="page">
                                                    <a class="page-link" href=<?php if (isset($categoryId)) echo "user.php?page=$i&user_level=$categoryId" ?> <?php if (!isset($categoryId)) echo "user.php?page=$i" ?>><?= $i ?>
                                                    </a>
                                                </li>
                                            <?php endfor; ?>

                                            <?php if ($page < $totalPage) { ?>
                                                <?php if (isset($categoryId)) { ?>
                                                    <a class="page-link" href="user.php?page=<?= $page + 1 ?>&user_level=<?= $categoryId ?>" aria-disabled="true">></a>
                                                <?php } else { ?>
                                                    <a class="page-link" href="user.php?page=<?= $page + 1 ?>">></a>
                                                <?php } ?>
                                            <?php  }
                                            $page = ''; ?>
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