<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_orders_classes.php'; ?>
<?php include_once '../order-item/_order_items_classes.php'; ?>

<?php
$is_edit = isset($_GET["id"]);

if ($is_edit) {
    $id = $_GET["id"];
    settype($id, 'integer');

    $edit_item = new Order();
    $edit_item->id = $id;
    $edit_item->refresh($conn);
}
?>

<div class="container main-container">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="lite-font-weight flex-row-container admin-breadcrumbs">
                <h6>
                    <a href="../index.php">Администрирование</a>
                </h6>
                <img class="breadcrumbs-delimiter" src="/img/breadcrumb-arrow.svg"></img>
                <h6>
                    <a href="./index.php">Оформленные заказы</a>
                </h6>
            </div>
        </div>
    </div>

    <form action="./update_item.php">
        <div class="form-group">
            <label for="id">ID</label>
            <input readonly class="form-control" id="id" name="id" value="<?php echo $edit_item->id ?>">
        </div>
        <div class="form-group">
            <label for="order_date">Дата заказа</label>
            <input readonly type="text" class="form-control" id="order_date" name="order_date" value="<?php echo $edit_item->order_date ?>">
        </div>
        <div class="form-group">
            <label for="client">Клиент</label>
            <input readonly type="text" class="form-control" id="client" name="client" value="<?php echo $edit_item->client->get_full_name_with_id() ?>">
        </div>
        <div class="form-group">
            <label for="total-product-count">Количество позиций</label>
            <input readonly type="number" class="form-control" id="total-product-count" name="total-product-count" value="<?php echo $edit_item->total_product_count ?>">
        </div>
        <div class="form-group">
            <label for="total-cost">Сумма</label>
            <input readonly type="number" class="form-control" id="total-cost" name="total-cost" value="<?php echo $edit_item->total_cost ?>">
        </div>
        <h3>Состав заказа</h3>
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
                $manager = new OrderItemManager();
                $all = $manager->getById($conn, $edit_item->id);
                $i = 1;
                foreach ($all as $item) {
                    echo "
                    <tr>
                        <th scope='row'>{$i}</th>
                        <td>{$item->product->name}</td>
                        <td>{$item->count}</td>
                        <td>{$item->cost_per_item}</td>
                        <td>{$item->discount_per_item}</td>
                    </tr>";
                    $i = $i + 1;
                }
                ?>

            </tbody>
        </table>
    </form>
</div>

<?php include '../../includes/footer.php';
