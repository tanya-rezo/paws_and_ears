<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_products_classes.php'; ?>

<div class="container main-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Картинка</th>
                <th scope="col">Комментарий</th>
                <th scope="col">Категория</th>
                <th scope="col">Бренд</th>
                <th scope="col">Страна</th>
                <th scope="col">Наличие скидки</th>
                <th scope="col">Цена по скидке</th>
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
                    <td>{$item->name}</td>
                    <td>{$item->price}</td>
                    <td>{$item->image}</td>
                    <td class='admin-comment-text'>{$item->description}</td>
                    <td>{$item->category->display_name}</td>
                    <td>{$item->brand->name}</td>
                    <td>{$item->manufacturer_country->name}</td>
                    <td>" . ($item->is_sale ? "Да" : "Нет") . "</td>
                    <td>{$item->sale_price}</td>
                    <td>
                        <a href='./edit.php'>Изменить</a>
                        <a href='./delete.php'>Удалить</a>
                    </td>
                </tr>
                ";
            }
            ?>

        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php';
