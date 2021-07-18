<?php
session_start();

$product_id = "product_" . $_GET["product"];

// удаление конкретного товара из корзины
unset($_SESSION[$product_id]);

header('Location: /cart.php');
