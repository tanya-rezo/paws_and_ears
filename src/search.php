<?php include './includes/header.php'; ?>
<?php include './includes/menu.php'; ?>
<?php include './includes/catalog-item.php'; ?>

<div class="container menu-container" style="display: none;">
    <?php include './includes/menu-content.php'; ?>
</div>

<div class="container main-container">

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-12 col-lg-9">
            <div class="lite-font-weight flex-row-container breadcrumbs">
                <h6>
                    <a href="index.php">Главная</a>
                </h6>
                <img class="breadcrumbs-delimiter" src="img/breadcrumb-arrow.svg"></img>
                <h6>Поиск</h6>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="d-none d-lg-block col-3 catalog-container">
            <?php include './includes/menu-content.php'; ?>
        </div>

        <div class="col-12 col-lg-9">

            <h3 class="mb-4">Поиск</h3>

            <?php
            if ($_GET["q"] == "") {
                echo "<div class='flex-column-container mt-150px vh-center'>";
                echo "  <img src='img/cat-in-box.svg' class='empty-screen-cat'>";
                echo "  <h5 class='empty-screen-text mt-3'>Введите поисковый запрос</h5>";
                echo "</div>";
            } else {

                echo "<div class='product-grid mb-4'>";

                $result = search_product($conn, $_GET["q"]); // отображаем найденные товары
                $count = 0;

                while ($row = mysqli_fetch_array($result)) {
                    print_catalog_item($row, true, $row["is_sale"] == "1");
                    $count = $count + 1;
                }

                echo "</div>";

                if ($count == 0) {
                    echo "<div class='flex-column-container mt-150px vh-center'>";
                    echo "  <img src='img/cat-in-box.svg' class='empty-screen-cat'>";
                    echo "  <h5 class='empty-screen-text mt-3'>По запросу «‎" . $_GET["q"] . "» ничего не найдено‎</h5>";
                    echo "</div>";
                }
            }
            ?>


        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>