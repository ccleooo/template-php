<?php
require_once("../../music-db-connect.php");

//判斷篩選有無成立
if (isset($_GET["category"])) {
    $A = $_GET["category"];
} else {
    $A = "0";
}
if ($A != "0") {
    $whsql = "WHERE article_category.id ='" . $_GET["category"] . "'";
} else {
    $whsql = "";
}
//JOIN語法 SELECT A.*, B.b FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)
$sql = "SELECT article.*, article_category.category_name FROM article 
  JOIN article_category ON article.article_category_id = article_category.id
  " . $whsql . "
  ";

$result = $conn->query($sql);
$articlerows = $result->fetch_all(MYSQLI_ASSOC);

$productCount = $result->num_rows;

//判斷當前頁
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

//叫出產品所有資料
$sqlAll = "SELECT * FROM article
ORDER BY id DESC";
$resultAll = $conn->query($sqlAll);

//每頁顯示數
$per_page = 6;

//運算頁面起始值
$page_start = ($page - 1) * $per_page;

//計算總頁數
$totalPage = ceil($productCount / $per_page);


//輸出
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
    <title>文章管理</title>
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
                    <div class="row ">
                        <div class="col-11 mx-auto ">
                            <div class="d-flex justify-content-between">
                                <div class="title">
                                        <h1 class="mb-3">文章管理</h1>
                                </div>
                                <?php if (isset($_GET["category"])) : ?>
                                    <div class="icon">
                                        <a class="btn text_btn" href="article-list.php">
                                            <i class="fa-solid fa-arrow-left me-2"></i>
                                            <p>文章管理</p>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="content shadow">
                                <div class="d-flex justify-content-between">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <p class="me-3">文章篩選</p>
                                            <?php
                                                $categorysql = "SELECT * FROM article_category ORDER BY id";
                                                $csql = $conn->query($categorysql);
                                            ?>
                                            <select class="form-select" name="category" id="category" class="text-input" style="height:auto" onChange="location.replace('article-list.php?category='+this.options[this.selectedIndex].value);">
                                                <option value="0" selected>所有文章
                                                <?php foreach ($csql as $csql) : ?>
                                                    <option value="<?= $csql["id"] ?>" <?php if ($A == $csql["id"]) {echo "selected";} ?>><?= $csql["category_name"] ?></option>
                                                <?php endforeach; ?>
                                        
                                        </select>
                                                                         
                                        <?php
                                        //計算頁面啟始結束值

                                        //JOIN語法 SELECT A.*, B.b FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)
                                        $sql = "SELECT article.*, article_category.category_name FROM article 
                                            JOIN article_category ON article.article_category_id = article_category.id 
                                            " . $whsql . "
                                            ORDER BY id  ASC LIMIT $page_start, $per_page
                                            ";
                                        $result = $conn->query($sql);                                     
                                        ?>
                                    </div>
                                    <div class="py-2 d-flex justify-content-end">
                                        <a class="btn btn-info" href="article-add.php">
                                            <i class="fa-solid fa-plus"></i>
                                            新增文章
                                        </a>
                                    </div>
                                </div>
                                <table class="table mt-4 table-hover">
                                    <thead>
                                        <tr>
                                            <th class="w-10">編號</th>
                                            <th class="w-20">文章標題</th>
                                            <th class="w-30">文章內容</th>
                                            <th>建立時間</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $result) : ?>
                                            <tr>
                                                <td><?= $result["id"] ?></td>
                                                <td><?= $result["article_title"] ?></td>
                                                <td>
                                                    <p class="multiline_ellipsis">
                                                        <?= $result["article_content"] ?>
                                                    </p>
                                                </td>
                                                <td><?= $result["create_time"] ?></td>
                                                <td>
                                                    <a class="btn btn-primary" href="article-detail.php?id=<?= $result["id"] ?>">檢視</a>
                                                    <button class="btn btn-danger delete-confirm" type="button" data-rowid="<?= $result["id"] ?>">刪除</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                                    <?php if (!isset($_GET["$A"])) : ?>
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <?php if ($page > 1) { ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="article-list.php?page=<?= $page - 1 ?>" aria-disabled="true"><</a>
                                                            </li>
                                                        <?php } ?>
                                                <?php
                                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item 
                                                <?php if ($i == $page || $A == $category) echo "active"; ?>" aria-current="page">
                                                        <a class="page-link" href="article-list.php?page=<?= $i ?>&category=<?= $A ?>"><?= $i ?><? $A ?>
                                                        </a>

                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($page < $totalPage) { ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="article-list.php?page=<?= $page + 1 ?>">></a>
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


            <!-- Confirm Modal -->
            <div class="modal fade" id="confirmBox" tabindex="-1" aria-labelledby="confirmBoxLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="confirmBoxLabel">刪除確認</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            確定要刪除嗎？一旦刪除便無法復原。
                            <!-- 增加隱藏欄位存資料 -->
                            <input type="hidden" id="target-id" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                            <!-- 刪除鈕必須上 ID，方便 JS 綁定 -->
                            <a href="article-delete.php?id=<?= $result["id"] ?>" type="button" class="btn btn-danger" id="fire-delete">確定</a>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const confirmModalElement = document.getElementById("confirmBox");
                    const confirmModal = new bootstrap.Modal(confirmModalElement);

                    confirmModalElement.addEventListener("hidden.bs.modal", event => {
                        const valueSaver = document.getElementById("target-id");
                        valueSaver.value = null;
                    });

                    const deleteBtns = document.querySelectorAll(".delete-confirm");
                    Array.from(deleteBtns).forEach(element => {
                        element.addEventListener("click", () => {
                            const rowId = element.dataset.rowid;

                            const valueSaver = document.getElementById("target-id");
                            valueSaver.value = rowId;

                            console.log(`此筆 ID 為: ${rowId}`);

                            confirmModal.show();
                        });
                    });

                    const fireDeleteBtn = document.getElementById("fire-delete");
                    fireDeleteBtn.addEventListener("click", function(event) {
                        const valueSaver = document.getElementById("target-id");
                        const targetId = valueSaver.value
                        console.log(`目標刪除 ID 為 ${targetId}`);

                        confirmModal.hide();
                    });
                });
            </script>
    <!-- js -->
    <?php include(dirname(__FILE__) . '../../../link/js.php') ?>
</body>

</html>