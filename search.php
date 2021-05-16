<?php include './includes/header.php'; ?>

<div class="container container-fill">
    <div class="row">

        <?php include './includes/menu.php'; ?>

        <div class="col-9">

            <h3 class="mb-4">Поиск</h3>

            <div class="product-grid">

                <?php
                $result = search_product($conn, $_GET["q"]); // отображаем найденные товары
                $count = 0;

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
                    $count = $count + 1;
                }
                ?>
            </div>

            <?php
            if ($count == 0) {
                echo "<h4 class='mb-4'>Товар не найден :(</h4>";
            }
            ?>

        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>