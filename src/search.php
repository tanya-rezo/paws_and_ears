<?php include './includes/header.php'; ?>

<div class="container container-fill">

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-12 col-lg-9">
            <div class="lite-font-weight flex-row-container breadcrumbs">
                <h6>
                    <a href="index.php">Главная</a>
                </h6>
                <h7 class="breadcrumbs-delimiter">></h7>
                <h6>Поиск</h6>
            </div>
        </div>
    </div>

    <div class="row">

        <?php include './includes/menu.php'; ?>

        <div class="col-12 col-lg-9">

            <h3 class="mb-4">Поиск</h3>

            <div class="product-grid mb-4">

                <?php
                $result = search_product($conn, $_GET["q"]); // отображаем найденные товары
                $count = 0;

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
                                    <div class=''>{$row["sale_price"]} ₽ </div>
                                </div>
                                </div>
                            </div>
                        </a>";
                    }

                    $count = $count + 1;
                }
                ?>
            </div>

            <?php
            if ($count == 0) {
                echo "<div class='flex-column-container mt-150px vh-center'>";
                echo "  <img src='img/cat-in-box.svg' class='empty-screen-cat'>";
                echo "  <h5 class='empty-screen-text mt-3'>По запросу «‎" . $_GET["q"] . "» ничего не найдено‎</h5>";
                echo "</div>";
            }
            ?>

        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>