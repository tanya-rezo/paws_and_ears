<?php
session_start();

$product_id = "product_" . $_GET["product"];

// уменьшаем на один счётчик конкретного товара (уменьшение количества в корзине)
$_SESSION[$product_id] = $_SESSION[$product_id] - 1;

// если количество конкретного товара = 0, то удаляем переменную из сессии 
if ($_SESSION[$product_id] == 0) {
    unset($_SESSION[$product_id]);
}

header('Location: /cart.php');
