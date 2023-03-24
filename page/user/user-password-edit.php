<?php
//寫入用 POST，顯示用 GET
if (!isset($_GET["id"])) {
    echo "無該商品";
    exit;
}

$id = $_GET["id"];

require_once("../../music-db-connect.php");

$sql = "SELECT * FROM user WHERE id='$id'";
$result = $conn -> query($sql);
$colorCount = $result -> num_rows;
$row = $result -> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>變更會員密碼</title>
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
                                    <h1 class="mb-3">會員密碼修改</h1>
                                </div>
                                <div class="icon">
                                    <a class="btn text_btn" href="user-edit.php?id=<?=$id?>">
                                        <i class="fa-solid fa-arrow-left me-2"></i>
                                        <p>編輯會員</p>
                                    </a>
                                </div>
                            </div>
                            <div class="detail_content shadow content_detial">
                                <form action="user-password-doUpdate.php" method="post">
                                    <input type="hidden" name="id" value="<?=$id?>">
                                    <table class="table table-bordered mt-3">
                                        <tbody>
                                            <tr>
                                                <td class="w-20">會員帳號</td>
                                                <td>
                                                   <?=$row["user_account"]?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-20">新密碼</td>
                                                <td class="password_style">
                                                    <input type="password" class="form-control" id="inputPassword" name="user_password" minlength="3" maxlength="20" required>
                                                    <i id="checkEye" class="fas fa-eye checkeye"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-primary" type="submit">變更</button>
                                    </div>
                                </form>
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