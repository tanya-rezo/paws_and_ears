<?php include './../database.php'; ?>
<?php include './_cart.php'; ?>
<?php
session_start();

if ($_GET["firstName"] == '' && $_GET["lastName"] == '' && $_GET["phoneNumber"] == '') {
    // проверям GET параметры на заполненность и при ошибке направляем обратно с флагом ошибки
    header('Location: /cart.php?error=1');
} else {
    // открываем транзакцию
    $conn->begin_transaction();

    // сохраняем данные о покупателе
    create_client($conn, $_GET["firstName"], $_GET["lastName"], $_GET["middleName"], $_GET["phoneNumber"]);
    $clientId = mysqli_insert_id($conn);

    $cart = new Cart($_SESSION);
    $cart->load($conn);

    // заводим заказ
    create_order($conn, $_GET["comment"], $clientId, $cart->total_cost, $cart->total_discount, $cart->cart_count);
    $orderId = mysqli_insert_id($conn);
    $orderGuid = mysqli_fetch_array(get_order_guid($conn, $orderId))['placed_order_guid'];

    // сохраняем содержимое корзины в заказ
    foreach ($cart->items as $product) {
        create_order_item($conn, $orderId, $product->id, $product->count, $product->price, $product->get_discount());
    }

    // фиксируем транзакцию
    $conn->commit();

    // чистим корзину и направляем на страницу подтверждения
    session_unset();
    header("Location: /order-created-page.php?guid=$orderGuid");

    disconnect_db($conn);
}
