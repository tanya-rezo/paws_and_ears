<?php include './includes/header.php'; ?>

<?php
$category = mysqli_fetch_array(get_category($conn, $_GET["category"]));
?>

<div class="container container-fill">

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-12 col-lg-9">
            <div class="lite-font-weight flex-row-container breadcrumbs">
                <h6>
                    <a href="index.php">Главная</a>
                </h6>
                <h7 class="breadcrumbs-delimiter">></h7>
                <h6><?php echo $category["category"] ?></h6>
            </div>
        </div>
    </div>

    <div class="row">

        <?php include './includes/menu.php'; ?>

        <div class="col-12 col-lg-9 mb-4">
            <div class="flex-row-container mb-4">
                <h3><?php echo $category["category"] ?></h3>
            </div>

            <div class="product-grid">

                <?php
                $result = get_products($conn, $category["id"]); // получаем товары заданной категории по id категории
                $product_count = 0;

                while ($row = mysqli_fetch_array($result)) {

                    if ($row["is_sale"] == "0") {
                        echo "
                        <a href='product.php?id={$row["id"]}'>
                            <div class='grid-item'>
                                <img src='products/{$row["image"]}' class='product-image' />
                                <div class='name-and-price-container'>
                                <div class='name-container'>
                                    <h8 class='name-text'>{$row["name"]}</h8>
                                </div>
                                <div class='price-container'>{$row["price"]} ₽</div>
                                </div>
                            </div>
                        </a>";
                    } else {
                        echo "
                        <a href='product.php?id={$row["id"]}'>
                            <div class='grid-item grid-item-sale'>
                                <img src='products/{$row["image"]}' class='product-image' />
                                <div class='name-and-price-container'>
                                <div class='name-container'>
                                    <h8 class='name-text'>{$row["name"]}</h8>
                                </div>
                                <div class='price-container'>
                                    <div class='old-price'>{$row["price"]} ₽ </div>  
                                    <div>{$row["sale_price"]} ₽ </div>
                                </div>
                                </div>
                            </div>
                        </a>";
                    }



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