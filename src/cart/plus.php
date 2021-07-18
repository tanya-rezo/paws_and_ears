<?php
session_start();

$product_id = "product_" . $_GET["product"];

// увеличиваем на один счётчик конкретного товара (увеличение количества в корзине)
$_SESSION[$product_id] = $_SESSION[$product_id] + 1;

header('Location: /cart.php');
