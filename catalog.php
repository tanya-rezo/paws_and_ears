<?php include './includes/header.php'; ?>

<div class="container container-fill">
    <div class="row">

        <?php include './includes/menu.php'; ?>

        <div class="col-9">
            <?php $category = mysqli_fetch_array(get_category($conn, $_GET["category"])); ?>

            <h3 class="mb-4"><?php echo $category["pet_type"] ?> - <?php echo $category["category"] ?></h3>

            <div class="product-grid">

                <?php
                $result = get_products($conn, $_GET["category"]); // получаем товары заданной категории
                $product_count = 0;

                while ($row = mysqli_fetch_array($result)) {
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
                    $product_count = $product_count + 1;
                }
                ?>
            </div>

            <?php
            if ($product_count == 0) {
                echo "<div class='flex-column-container mt-130px vh-center'>";
                echo "  <img src='img/cat-in-box.svg' class='empty-screen-cat'>";
                echo "  <h5 class='empty-screen-text mt-3'>В этой категории пока пусто</h5>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>