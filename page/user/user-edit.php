<?php
require_once("../../music-db-connect.php");


if (!isset($_GET["id"])) {
    echo "使用者不存在";
    exit;
}

$sqlCategory = "SELECT * FROM user_level ORDER BY id ASC";
$resultCategory = $conn->query($sqlCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);

$id = $_GET["id"];

$sql = "SELECT user.*, user_level.level_name FROM user JOIN user_level ON user.user_level_id = user_level.id WHERE user.id='$id' AND user_valid=1";
$result = $conn->query($sql);
$userCount = $result->num_rows;

$row = $result->fetch_assoc();
// var_dump($row);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>會員管理-編輯會員</title>
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
                        <div class="col-9 mx-auto user">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                    <h1 class="mb-3">編輯會員</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="user-detail.php?id=<?= $row["id"] ?>">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>會員資訊</p>
                                    </a>
                                </div>
                            </div>
                            <div class="detail_content shadow">
                                <form action="user-doUpdate.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    <table class="table table-bordered mt-2">
                                        <tbody>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>帳號</p>
                                                </td>
                                                <td class="w-40">
                                                    <input type="hidden" name="account" value="<?= $row["user_account"] ?>">
                                                    <?= $row["user_account"] ?>
                                                </td>
                                                <td class="bg_gray">
                                                    <p>姓名</p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="<?= $row["user_name"] ?>" name="name">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>密碼</p>
                                                </td>
                                                <td class="w-40 password_style">
                                                    <a class="btn btn-dark" href="user-password-edit.php?id=<?= $row["id"] ?>">變更密碼</a>
                                                </td>
                                                <td class="bg_gray">
                                                    <p>生日</p>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" value="<?= $row["user_birthday"] ?>" name="birthday">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>會員等級 </p>
                                                </td>
                                                <td class="w-40">
                                                    <select class="form-select select_large" aria-label="Default select example" name="user_level" id="user_level">
                                                        <?php
                                                        foreach ($rowsCategory as $category) {
                                                            $category_id = $category['id'];
                                                            $category_name = $category['level_name'];

                                                            if ($row['user_level_id'] == $category_id) {
                                                                echo "<option value=\"$category_id\" selected>$category_name</option>";
                                                            } else {
                                                                echo "<option value=\"$category_id\">$category_name</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td class="bg_gray">
                                                    <p>手機</p>
                                                </td>
                                                <td>
                                                    <input type="phone" class="form-control" value="<?= $row["user_phone"] ?>" name="phone">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>Email</p>
                                                </td>
                                                <td class="w-40">
                                                    <input type="email" class="form-control" value="<?= $row["user_mail"] ?>" name="email">
                                                </td>
                                                <td class="bg_gray">
                                                    <p>地址</p>
                                                </td>
                                                <td>
                                                    <input type="address" class="form-control" value="<?= $row["user_address"] ?>" name="address">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>會員圖片</p>
                                                </td>
                                                <td colspan="3">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <!-- 帶原本的圖片檔案名稱 -->
                                                            <input type="hidden" name="user_img_old" value="<?= $row["user_img"] ?>">
                                                            <input type="file" accept="img/*" class="form-control" id="user_img" name="user_img" onchange="loadFile(event)">
                                                        </div>
                                                        <div class="col-6 py-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-6">
                                                                    <img class="img_old rounded-circle" src="../../upload/user/<?= $row["user_img"] ?>">
                                                                </div>
                                                                <div class="col-6">
                                                                    <img id="output" class="img_new rounded-circle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-primary" type="submit">儲存</button>
                                    </div>
                                </form>
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
    <script>
        // 單圖預覽
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.classList.add('img_border')); // free memory
            }
        };
    </script>
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>