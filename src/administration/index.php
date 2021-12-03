<?php include './includes/header.php'; ?>
<?php include_once '../database.php'; ?>

<?php $counters = mysqli_fetch_array(admin_get_count_columns($conn)); ?>

<div class="container main-container">
    <div class="vh-center">
        <img class="admin-logo" src="../img/logo.svg">
    </div>
    <div class="row">
        <div class="col-4">
            <a class="text-decoration-none" role="button" href="pet-type">
                <div class="admin-tile flex-column-container justify-content-around align-items-end">
                    <h1 class="admin-tile-text mr-3"><?php echo $counters["count_pet_type"] ?></h1>
                    <h3 class="admin-tile-text mr-3">Виды животных</h3>
                </div>
            </a>
        </div>

        <div class="col-4">
            <a class="text-decoration-none" role="button" href="categories">
                <div class="admin-tile flex-column-container justify-content-around align-items-end">
                    <h1 class="admin-tile-text mr-3"><?php echo $counters["count_category"] ?></h1>
                    <h3 class="admin-tile-text mr-3">Категории</h3>
                </div>
            </a>
        </div>

        <div class="col-4">
            <a class="text-decoration-none" role="button" href="products">
                <div class="admin-tile flex-column-container justify-content-around align-items-end">
                    <h1 class="admin-tile-text mr-3"><?php echo $counters["count_product"] ?></h1>
                    <h3 class="admin-tile-text mr-3">Товары</h3>
                </div>
            </a>
        </div>

        <div class="col-4">
            <a class="text-decoration-none" role="button" href="brands">
                <div class="admin-tile flex-column-container justify-content-around align-items-end">
                    <h1 class="admin-tile-text mr-3"><?php echo $counters["count_brand"] ?></h1>
                    <h3 class="admin-tile-text mr-3">Бренды</h3>
                </div>
            </a>
        </div>

        <div class="col-4">
            <a class="text-decoration-none" role="button" href="manufacturing-countries">
                <div class="admin-tile flex-column-container justify-content-around align-items-end">
                    <h1 class="admin-tile-text mr-3"><?php echo $counters["count_manufacturer_country"] ?></h1>
                    <h3 class="admin-tile-text mr-3 text-right">Страны<br>производители</h3>
                </div>
            </a>
        </div>

        <div class="col-4">
            <a class="text-decoration-none" role="button" href="orders">
                <div class="admin-tile flex-column-container justify-content-around align-items-end">
                    <h1 class="admin-tile-text mr-3"><?php echo $counters["count_placed_order"] ?></h1>
                    <h3 class="admin-tile-text mr-3 text-right">Оформленные<br>заказы</h3>
                </div>
            </a>
        </div>

        <div class="col-4">
            <a class="text-decoration-none" role="button" href="clients">
                <div class="admin-tile flex-column-container justify-content-around align-items-end">
                    <h1 class="admin-tile-text mr-3"><?php echo $counters["count_client"] ?></h1>
                    <h3 class="admin-tile-text mr-3">Клиенты</h3>
                </div>
            </a>
        </div>
    </div>
</div>
<?php include '../includes/footer.php';
