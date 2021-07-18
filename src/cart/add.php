<?php
session_start();

$product_id = "product_" . $_GET["product"];

// каждая переменная сессии это счётчик количества определённого товара в корзине

// если товара ещё нет в корзине, то добавляем 1
// иначе увеличиваем счётчик на 1
if (!isset($_SESSION[$product_id])) {
    $_SESSION[$product_id] = 1;
} else {
    $_SESSION[$product_id] = $_SESSION[$product_id] + 1;
}

if (!isset($_GET["go_to_cart"])) {
    header('Location: /product.php?id=' . $_GET["product"]);
} else {
    header('Location: /cart.php');
}
