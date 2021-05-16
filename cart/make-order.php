<?php
session_start();

if ($_GET["firstName"] == '' && $_GET["lastName"] == '' && $_GET["phoneNumber"] == '') {
    // проверям GET параметры на заполненность и при ошибке направляем обратно с флагом ошибки
    header('Location: /cart.php?error=1');
} else {
    // чистим корзину и направляем на страницу подтверждения
    session_unset();
    header('Location: /status-page.php');
}
