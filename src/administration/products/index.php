<?php include './check-rights.php'; ?>
<?php
$title = "Товары";
include '../includes/header.php';
?>
<?php include_once '../../database.php'; ?>
<?php include_once './_products_classes.php'; ?>

<div class="container main-container">
    <div class="row">
        <div class="col-12">
            <div class="flex-row-container mb-3">
                <div class="lite-font-weight flex-row-container admin-breadcrumbs">
                    <h6>
                        <a href="../index.php">Администрирование</a>
                    </h6>
                    <img class="breadcrumbs-delimiter" src="/img/breadcrumb-arrow.svg"></img>
                    <h6>Товары</h6>
                </div>
                <a class="btn btn-primary admin-btn mt-40px" href="./create.php">Создать</a>
            </div>
        </div>
    </div>

    <?php include '../includes/crud_messages.php'; ?>

    <table class="table table-hover mb-4">
        <thead>
            <tr>
                <th scope="col" style="min-width:52px">ID</th>
                <th scope="col" style="min-width:216px">Картинка</th>
                <th scope="col" style="min-width:190px">Название</th>
                <th scope="col">Цена</th>
                <th scope="col" style="min-width:150px">Категория</th>
                <th scope="col" style="min-width:115px">Бренд</th>
                <th scope="col" style="min-width:100px">Страна</th>
                <th scope="col">Наличие скидки</th>
                <th scope="col" style="min-width:90px">Цена по скидке</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $manager = new ProductManager();
            $all = $manager->getAll($conn);
            foreach ($all as $item) {
                echo "
                <tr>
                    <th scope='row'>{$item->id}</th>
                    <td><img class='admin-product-image-preview' src='/products/{$item->image}'></td>
                    <td>{$item->name}</td>
                    <td>{$item->price}</td>
                    <td>{$item->category->full_name}</td>
                    <td>{$item->brand->name}</td>
                    <td>{$item->manufacturer_country->name}</td>
                    <td>" . ($item->is_sale ? "Да" : "Нет") . "</td>
                    <td>{$item->sale_price}</td>
                    <td>
                        <a href='./edit.php?id={$item->id}'>Изменить</a>
                        <a href='./delete.php?id={$item->id}'>Удалить</a>
                    </td>
                </tr>
                ";
            }
            ?>

        </tbody>
    </table>
</div>

<?php include '../includes/footer.php';
