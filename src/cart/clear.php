<?php
session_start();

// удаляем все переменные сессии
// т.к. в сессии хранятся только товары из корзины то это равнозначно чистке корзины
session_unset();

header('Location: /cart.php');