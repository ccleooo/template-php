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

// var_dump($row);
// exit;
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $row["title"] ?></title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
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
                    <div class="row">
                        <div class="col-10 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">文章編輯</h1>
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
                                    <form action="article-Update.php" method="post" enctype="multipart/form-data">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                    <td>id</td>
                                                    <td>
                                                        <?= $row["id"] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>文章標題</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?= $row["article_title"] ?>" name="title">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>文章內容</td>
                                                    <td>

                                                        <textarea type="text" class="form-control" name="content" rows="3"><?= $row["article_content"] ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>文章圖片</td>
                                                    <td>
                                                        <div class="mb-2">
                                                            <input type="hidden" name="old_img" value="<?= $row["article_img"] ?>">
                                                            <input type="file" id="article_img" name="article_img" class="form-control">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <button class="btn btn-primary" type="submit">儲存</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
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

    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>