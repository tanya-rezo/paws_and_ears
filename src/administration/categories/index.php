<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_categories_classes.php'; ?>

<div class="container main-container">
    <a class="btn btn-primary" href="./create.php">Создать</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Полное название</th>
                <th scope="col">Вид животного</th>
                <th scope="col">URL-адрес</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $manager = new CategoryManager();
            $all = $manager->getAll($conn);
            foreach ($all as $item) {
                echo "
                <tr>
                    <th scope='row'>{$item->id}</th>
                    <td>{$item->display_name}</td>
                    <td>{$item->full_name}</td>
                    <td>{$item->pet_type->name}</td>
                    <td>{$item->url_name}</td>
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

<?php include '../../includes/footer.php';
