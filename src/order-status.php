<?php include './includes/header.php'; ?>

<?php
$guid = $_GET["id"];
$id = mysqli_fetch_array(get_order_id($conn, $guid))['placed_order_id'];

$order = mysqli_fetch_array(get_order($conn, $id));
$order_items_result = get_order_items($conn, $id);
?>

<div class="container main-container">
    <div class="mt-3 vh-center">
        <a href="/index.php">
            <img class="logo-space mr-0" src="/img/logo.svg">
        </a>
    </div>
    <div class="mt-4">
        <h3 class="mt-3">
            <span>Заказ №<?= $order['placed_order_id'] ?></span>
        </h3>

        <h5 class="mt-3">
            Статус
            <span class="badge badge-info font-weight-normal p-2 ml-1"><?= $order['order_status_name'] ?></span>
        </h5>

        <p class="py-2"><?= $order['order_status_message'] ?></p>

        <h5>Состав заказа</h5>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Товар</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Цена за шт</th>
                    <th scope="col">Скидка за шт</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $i = 1;
                while ($row = mysqli_fetch_array($order_items_result)) {
                    echo "
                    <tr>
                        <th scope='row'>{$i}</th>
                        <td>{$row['product_name']}</td>
                        <td>{$row['placed_order_item_count']}</td>
                        <td>{$row['placed_order_item_cost_per_item']}</td>
                        <td>{$row['placed_order_item_discount_per_item']}</td>
                    </tr>";
                    $i = $i + 1;
                }
                ?>

            </tbody>
        </table>
        <h5>Итого с учётом скидки: <?= $order['placed_order_total_cost'] ?> ₽ </h5>
    </div>
</div>

<?php include './includes/footer.php'; ?>