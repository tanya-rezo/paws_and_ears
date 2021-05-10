<!-- <% var data={ title: "Подробности о товаре" , }; %> -->
<?php include './includes/header.php'; ?>

<div class="container container-fill">
    <div class="row">
        <?php include './includes/menu.php'; ?>

        <?php 
        $result = get_product($conn, $_GET["id"]); 
        $product = mysqli_fetch_array($result);
        ?>

        <div class="col-9">
            <h2 class="mb-4"><?php echo $product["name"] ?></h2>
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
                        <div><span><?php echo $product["pet_type"] ?> - <?php echo $product["category"] ?></span></div>
                        <div><span>В наличии</span></div>
                        <div><span><?php echo $product["brand"] ?></span></div>
                        <div><span><?php echo $product["manufacturer"] ?></span></div>
                    </div>

                    <div class="container-fill"></div>

                    <div class="position-relative mb-3">
                        <div class="details-headers"><span>Цена</span></div>
                        <div class="details-price-text"><?php echo $product["price"] ?> ₽</div>
                    </div>

                    <a role="button" class="btn btn-primary details-add-to-card-btn" href="#">Добавить в
                        корзину</a>
                </div>
            </div>
            <div class="row mt-4 mb-3 text-justify">
                <div class="col-12">
                    <?php echo nl2br($product["description"]) ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include './includes/footer.php'; ?>