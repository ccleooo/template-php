<?php

require_once("../../music-db-connect.php");

$sql = "SELECT * FROM `article` WHERE 1 ";
$result = $conn->query($sql);
$userCount = $result->num_rows;
$row = $result->fetch_assoc();

$sql2 = "SELECT * FROM article_category ORDER BY id ASC";
$result2 = $conn->query($sql2);

$rows2 = $result2->fetch_all(MYSQLI_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Article</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
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
                        <div class="col-10 mx-auto ">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="mb-3">文章新增</h1>
                                <div class="icon">
                                    <a class="btn text_btn" href="article-list.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>文章管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="content shadow">
                                <form action="article-insert.php" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered mt-4">
                                        <tbody>
                                            <tr>
                                                <td class="bg_gray">文章篩選</td>
                                                <td>
                                                    <select class="form-select" name="category" id="category">
                                                        <?php foreach ($rows2 as $csql) : ?>
                                                            <option value="<?= $csql["id"] ?>"><?= $csql["category_name"] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">文章標題</td>
                                                <td>
                                                    <input type="text" class="form-control" id="title" name="title">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">文章內容</td>
                                                <td>
                                                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg_gray">文章圖片</td>
                                                <td>
                                                    <input type="file" name="myFile" class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">儲存</button>
                                    </div>
                                </form>
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