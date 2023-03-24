<?php

if (!isset($_GET["id"])) {
    echo "使用者不存在";
    exit;
}

$id = $_GET["id"];

require_once("../../music-db-connect.php");

$sql = "SELECT * FROM `article` WHERE id='$id' ";
$result = $conn->query($sql);
$userCount = $result->num_rows;

$row = $result->fetch_assoc();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $row["title"] ?></title>
    <?php include(dirname(__FILE__) . '../../../link/header.php')?>
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
                                    <h1 class="mb-3">文章資訊</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="article-list.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>文章管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <?php if ($userCount == 0) : ?>
                                    使用者不存在
                                <?php else : ?>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="bg_gray">id</td>
                                                <td><?= $row["id"] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">文章標題</td>
                                                <td><?= $row["article_title"] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">建立時間</td>
                                                <td><?= $row["create_time"] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">文章內容</td>
                                                <td>
                                                    <?= $row["article_content"] ?>
                                                    <img class="img-fluid" src="../../upload/article/<?= $row["article_img"] ?>" alt=""> 
                                                </td>
                                            </tr>
                            
                                        </tbody>
                                    </table>
                                    <div class="py-2">
                                        <a class="btn btn-info" href="article-edit.php?id=<?= $row["id"] ?>">編輯文章</a>
                                    </div>
                                <?php endif; ?>
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