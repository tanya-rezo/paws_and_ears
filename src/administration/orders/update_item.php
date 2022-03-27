<?php include_once '../../database.php'; ?>
<?php include_once './_orders_classes.php'; ?>
<?php

$is_edit = isset($_GET["id"]);

// получаем GET параметры
$id = $_GET["id"];
$order_status_id = $_GET["order-status"];

// чистим данные от SQL инъекций
settype($id, 'integer');
settype($order_status_id, 'integer');

// создаём объект и наполняем
$item = new Order();
$item->id = $id;
$item->order_status = new OrderStatus();
$item->order_status->id = $order_status_id;

if ($is_edit) {
    // обновляем в БД
    $item->save($conn);
}

header('Location: ./index.php');
disconnect_db($conn);
