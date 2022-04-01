<?php
$title = "Заказы";
include '../includes/header.php';
?>
<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_orders_classes.php'; ?>

<div class="container main-container">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="lite-font-weight flex-row-container admin-breadcrumbs">
                <h6>
                    <a href="../index.php">Администрирование</a>
                </h6>
                <img class="breadcrumbs-delimiter" src="/img/breadcrumb-arrow.svg"></img>
                <h6>Заказы</h6>
            </div>
        </div>
    </div>

    <?php include '../includes/crud_messages.php'; ?>

    <table class="table table-hover mb-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Статус</th>
                <th scope="col">Дата</th>
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
                    <td>{$item->order_status->name}</td>
                    <td>{$item->order_date}</td>
                    <td>{$item->client->get_full_name_with_id()}</td>
                    <td>{$item->total_product_count}</td>
                    <td>{$item->total_cost}</td>
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
