<?php

require_once("../../music-db-connect.php");

//JOIN語法 SELECT A.*, B.b FROM A JOIN B ON A.a_id = B.id (a是A的副鍵)

//判斷篩選有無成立
if (isset($_GET["category"])) {
    $A = $_GET["category"];
} else {
    $A = "0";
}

if ($A != "0") {
    $whsql = "WHERE product_category.id='" . $_GET["category"] . "AND product.product_valid=1'";
} else {
    $whsql = "";
}

$sql = "SELECT product.*, product_category.category_name FROM product JOIN product_category ON  product.category_id= product_category.id
  " . $whsql . "AND product.product_valid=1
  ";

//輸出資料庫內容
$result = $conn->query($sql);
$productrows = $result->fetch_all(MYSQLI_ASSOC);

//總計商品
$productCount = $result->num_rows;

//判斷當前頁
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

//叫出產品所有資料
$sqlAll = "SELECT * FROM product WHERE product.product_valid=1 ";
$resultAll = $conn->query($sqlAll);

//每頁顯示數
$per_page = 10;

//運算頁面起始值
$page_start = ($page - 1) * $per_page;

//計算總頁數
$totalPage = ceil($productCount / $per_page);


//輸出
$rows = $resultAll->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>商品管理</title>
    <?php include(dirname(__FILE__) . '../../../link/header.php') ?>
    <link href="../../css/product.css" rel="stylesheet">
    <style>
        .form-select,
        .myForm {
            max-width: 100%;
            text-align: center;
        }

    </style>
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
                        <div class="col-lg-11 mx-auto product">
                            <h1 class="mb-4">商品管理</h1>
                            <div class="content shadow">
                                <div class="row d-flex justify-content-between">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <form class="d-flex align-items-center" name="myForm">
                                            <p class="font_width">商品種類</p>
                                            <?php
                                            $categorysql = "SELECT * FROM product_category ORDER BY id ";
                                            $csql = $conn->query($categorysql);
                                            ?>
                                            <select class="form-select" name="category" id="category" class="text-input" style="height:auto" onChange="location.replace('product.php?category='+this.options[this.selectedIndex].value);">
                                                <option value="0" selected>請選擇
                                                    <?php foreach ($csql as $csql) : ?></option>
                                                <option value="<?= $csql["id"] ?>" <?php if ($A == $csql["id"]) { echo "selected"; } ?>>
                                                    <?= $csql["category_name"] ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </form>
                                        <?php
                                        //計算頁面啟始結束值
                                        $sql = "SELECT product.*, product_category.category_name FROM product 
                                            JOIN product_category ON product.category_id= product_category.id 
                                            " . $whsql . " AND product.product_valid=1 ORDER BY id ASC LIMIT $page_start, $per_page
                                            ";
                                        $result = $conn->query($sql);
                                        ?>

                                        <div class="col-auto mt-4 text-end">
                                            <a href="product-add.php" class="btn btn-info margin ">
                                                <i class="fa-solid fa-plus"></i>
                                                商品上架
                                            </a>
                                        </div>
                                    </div>

                                    <div class="py-2 text-start">
                                        共 <?= $productCount ?> 項
                                    </div>
                                </div>

                                <table class="table table-hover mt-4">
                                    <thead>
                                        <tr>
                                            <th>編號</th>
                                            <th>商品圖</th>
                                            <th>商品種類</th>
                                            <th>商品名稱</th>
                                            <th>價格</th>
                                            <th>庫存</th>
                                            <th>上架時間</th>
                                            <th>商品狀態</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <?php if ($productCount > 0) : ?>
                                        <tbody>
                                            <?php foreach ($result as $result) : ?>
                                                <tr>
                                                    <td><?= $result["id"] ?></td>
                                                    <td>
                                                        <img class="max_height" src="../../upload/product-subject/<?= $result["subject_img"] ?>">
                                                    </td>
                                                    <td><?= $result["category_name"] ?></td>

                                                    <td><?= $result["product_name"] ?></td>
                                                    <td><?= $result["product_price"] ?></td>
                                                    <td><?= $result["inventory"] ?></td>
                                                    <td><?= $result["create_time"] ?></td>
                                                    <td>
                                                        <?php if ($result["product_valid"] == "1") {
                                                            echo "已上架";
                                                        } else {
                                                            echo "下架中";
                                                        }
                                                        ?>
                                                    </td>

                                                    <td class="text-center gap-2 mt-3 ">
                                                        <a class="btn btn-primary" href="product-detail.php?id=<?= $result["id"] ?>">檢視</a>
                                                        <button class="btn btn-danger delete-confirm" type="button" data-rowid="<?= $result["id"] ?>">刪除</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    <?php endif; ?>
                                </table>

                                <div class="d-flex justify-content-center mt-4">
                                    <?php if (!isset($_GET["$A"])) : ?>
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                <?php if ($page > 1) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="product.php?page=<?= $page - 1 ?>&category=<?= $A ?>" aria-disabled="true">
                                                            <</a>
                                                    </li>
                                                <?php } ?>

                                                <?php
                                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                                                    <li class="page-item 
                                                <?php if ($i == $page || $A == $category) echo "active"; ?>" aria-current="page">
                                                        <a class="page-link" href="product.php?page=<?= $i ?>&category=<?= $A ?>"><?= $i ?><? $A ?>
                                                        </a>

                                                    </li>
                                                <?php endfor; ?>

                                                <?php if ($page < $totalPage) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="product.php?page=<?= $page + 1 ?>&category=<?= $A ?>">></a>
                                                    </li>
                                                <?php  }
                                                $page = ''; ?>
                                            </ul>
                                        </nav>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- /.container-fluid -->
                        </div>
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
                            <a href="product-delete.php?id=<?= $result["id"] ?>" type="button" class="btn btn-danger" id="fire-delete">確定</a>
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