<?php include './../database.php'; ?>
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

    // заводим заказ
    create_order($conn, $_GET["comment"], $clientId);
    $orderId = mysqli_insert_id($conn);

    // сохраняем содержимое корзины в заказ
    foreach ($_SESSION as $product_id => $count) {
        // обрезаем имя переменной сессии чтобы получить id товара
        // "product_3" -> "3"
        $id = intval(substr($product_id, 8));

        create_order_item($conn, $orderId, $id, intval($count));
    }

    // фиксируем транзакцию
    $conn->commit();

    // чистим корзину и направляем на страницу подтверждения
    session_unset();
    header('Location: /status-page.php');

    disconnect_db($conn);
}
