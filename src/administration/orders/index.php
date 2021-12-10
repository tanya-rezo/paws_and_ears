<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_orders_classes.php'; ?>

<div class="container main-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Клиент</th>
                <th scope="col">Количество позиций</th>
                <th scope="col">Сумма</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $manager = new OrderManager();
            $all = $manager->getAll($conn);
            foreach ($all as $item) {
                echo "
                <tr>
                    <th scope='row'>{$item->id}</th>
                    <td>{$item->client->get_full_name_with_id()}</td>
                    <td>{$item->total_product_count}</td>
                    <td>{$item->total_cost}</td>
                    <td>
                        <a href='./show.php?id={$item->id}'>Посмотреть</a>
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
