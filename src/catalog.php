<?php include_once './database.php'; ?>
<?php
$category = mysqli_fetch_array(get_category($conn, $_GET["category"]));
if ($category == null) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    include '404.php';
    die();
}
?>
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
                <h6><?php echo $category["category"] ?></h6>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="d-none d-lg-block col-3 catalog-container">
            <?php include './includes/menu-content.php'; ?>
        </div>

        <div class="col-12 col-lg-9 mb-4">
            <div class="flex-row-container mb-4">
                <h3><?php echo $category["category"] ?></h3>
            </div>

            <div class="product-grid">

                <?php
                $result = get_products($conn, $category["id"]); // получаем товары заданной категории по id категории
                $product_count = 0;

                while ($row = mysqli_fetch_array($result)) {
                    print_catalog_item($row, true, $row["is_sale"] == "1");
                    $product_count = $product_count + 1;
                }
                ?>
            </div>

            <?php
            if ($product_count == 0) {
                echo "<div class='flex-column-container mt-150px vh-center'>";
                echo "  <img src='img/cat-in-box.svg' class='empty-screen-cat'>";
                echo "  <h5 class='empty-screen-text mt-3'>В этой категории пока пусто</h5>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>