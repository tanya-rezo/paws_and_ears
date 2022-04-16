<?php
session_start();

// удаляем все товары из сессии
foreach ($_SESSION as $key => $value) {
    if (substr($key, 0, 8) == "product_") {
        unset($_SESSION[$key]);
    }
}

header('Location: /cart.php');
