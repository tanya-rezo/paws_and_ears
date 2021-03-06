<?php include './includes/header.php'; ?>
<?php include_once '../database.php'; ?>
<?php include './admin-common.php'; ?>

<?php $counters = mysqli_fetch_array(admin_get_count_columns($conn)); ?>

<div class="container main-container">
    <div class="mt-3 mb-1 vh-center">
        <a href="/index.php">
            <img class="logo-space mr-0" src="../img/logo.svg">
        </a>
    </div>

    <?php include './includes/crud_messages.php'; ?>

    <div class="row">
        <?php if (current_user_is_admin() || current_user_is_manager()) : ?>
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
        <?php endif ?>

        <?php if (current_user_is_admin() || current_user_is_manager() || current_user_is_operator()) : ?>
            <div class="col-4">
                <a class="text-decoration-none" role="button" href="orders">
                    <div class="admin-tile flex-column-container justify-content-around align-items-end">
                        <h1 class="admin-tile-text mr-3"><?php echo $counters["count_placed_order"] ?></h1>
                        <h3 class="admin-tile-text mr-3 text-right">Заказы</h3>
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
        <?php endif ?>

        <?php if (current_user_is_admin()) : ?>
            <div class="col-4">
                <a class="text-decoration-none" role="button" href="users">
                    <div class="admin-tile flex-column-container justify-content-around align-items-end">
                        <h1 class="admin-tile-text mr-3"><?php echo $counters["count_user"] ?></h1>
                        <h3 class="admin-tile-text mr-3">Пользователи</h3>
                    </div>
                </a>
            </div>
        <?php endif ?>

    </div>
</div>
<?php include './includes/footer.php'; ?>