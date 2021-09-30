<?php include './includes/header.php'; ?>

<?php
$result = get_product($conn, $_GET["id"]);
$product = mysqli_fetch_array($result);
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
                <h6>
                    <a href="/catalog.php?category=<?php echo $product["category_url_name"] ?>"><?php echo $product["category_full_name"] ?></a>
                </h6>
                <h7 class="breadcrumbs-delimiter">></h7>
                <h6><?php echo $product["name"] ?></h6>
            </div>
        </div>
    </div>

    <div class="row">

        <?php include './includes/menu.php'; ?>

        <div class="col-12 col-lg-9">
            <h3 class="mb-4"><?php echo $product["name"] ?></h3>
            <div class="row">
                <div class="col-7">
                    <img class="details-product-image" src="products/<?php echo $product["image"] ?>" />
                </div>
                <div class="col-5 flex-column-container">
                    <div class="details-headers">
                        <div><span>Артикул</span></div>
                        <div><span>Категория</span></div>
                        <div><span>Наличие</span></div>
                        <div><span>Бренд</span></div>
                        <div><span>Страна</span></div>
                    </div>

                    <div class="details-values">
                        <div><span><?php echo $product["id"] ?></span></div>
                        <div><span><?php echo $product["category_full_name"] ?></span></div>
                        <div><span>В наличии</span></div>
                        <div><span><?php echo $product["brand"] ?></span></div>
                        <div><span><?php echo $product["manufacturer"] ?></span></div>
                    </div>

                    <div class="container-fill"></div>

                    <div class="position-relative mb-3">
                        <div class="details-headers"><span>Цена</span></div>
                        <?php
                        if ($product["is_sale"] == "0") {
                            echo "<div class='details-price-text'>{$product["price"]} ₽</div>";
                        } else {
                            echo "<div class='details-price-text'>{$product["sale_price"]} ₽</div>
                                  <div class='sale-price'>{$product["price"]} ₽</div>";
                        }
                        ?>
                    </div>

                    <a role="button" class="btn btn-primary details-add-to-card-btn" href="/cart/add.php?product=<?php echo $product["id"] ?>">Добавить в
                        корзину</a>

                    <a role="button" class="btn btn-primary details-add-to-card-btn mt-2" href="/cart/add.php?product=<?php echo $product["id"] ?>&go_to_cart=1">Добавить и перейти в корзину</a>
                </div>
            </div>
            <div class=" row mt-4 mb-3 text-justify">
                <div class="col-12">
                    <?php echo nl2br($product["description"]) ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include './includes/footer.php'; ?>