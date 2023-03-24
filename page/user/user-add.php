<?php
require_once("../../music-db-connect.php");

$sqlCategory = "SELECT * FROM user_level ORDER BY id ASC";
$resultCategory = $conn->query($sqlCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>會員管理-新增會員</title>
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
                                    <h1 class="mb-3">新增會員</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="user.php">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>會員管理</p>
                                    </a>
                                </div>
                            </div>
                            <div class="detail_content shadow">
                                <form action="user-doInsert.php" method="post" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered mt-2">
                                        <tbody>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>帳號</p>
                                                </td>
                                                <td class="w-40">
                                                    <input type="text" class="form-control" id="account" name="account" required>
                                                </td>
                                                <td class="bg_gray">
                                                    <p>姓名</p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>密碼</p>
                                                </td>
                                                <td class="w-40 password_style">
                                                    <input type="password" class="form-control" id="inputPassword" name="password" minlength="3" maxlength="20" required>
                                                    <i id="checkEye" class="fas fa-eye checkeye"></i>
                                                </td>
                                                <td class="bg_gray">
                                                    <p>生日</p>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>會員等級 </p>
                                                </td>
                                                <td class="w-40">
                                                    <select class="form-select select_large" aria-label="Default select example" name="user_level" id="user_level">
                                                        <option selected>選擇會員等級</option>
                                                        <?php foreach ($rowsCategory as $category) : ?>
                                                            <option value="<?= $category["id"] ?>"><?= $category["level_name"] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td class="bg_gray">
                                                    <p>手機</p>
                                                </td>
                                                <td>
                                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-10 bg_gray">
                                                    <p>Email</p>
                                                </td>
                                                <td class="w-40">
                                                    <input type="email" class="form-control" id="email" name="email" required>
                                                </td>
                                                <td class="bg_gray">
                                                    <p>地址</p>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="address" name="address" required>
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
                                                            <input type="file" accept="img/*" class="form-control" id="user_img" name="user_img" onchange="loadFile(event)">
                                                        </div>
                                                        <div class="col-6 py-3">
                                                            <img id="output" class="user_image rounded-circle">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">送出</button>
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
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        // checkEye
        var checkEye = document.getElementById("checkEye");
        var floatingPassword = document.getElementById("inputPassword");
        checkEye.addEventListener("click", function(e) {
            if (e.target.classList.contains('fa-eye')) {
                //換class 病患 type
                e.target.classList.remove('fa-eye');
                e.target.classList.add('fa-eye-slash');
                floatingPassword.setAttribute('type', 'text')
            } else {
                floatingPassword.setAttribute('type', 'password');
                e.target.classList.remove('fa-eye-slash');
                e.target.classList.add('fa-eye')
            }
        });
    </script>
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>