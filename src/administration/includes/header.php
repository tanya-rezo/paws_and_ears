<?php session_start(); ?>
<?php

$is_user_logged_in = isset($_SESSION['user_login']);
$is_login_page = substr($_SERVER['REQUEST_URI'], 0, 25) == '/administration/login.php';

// перенаправление на страницу логина, если пользователь не авторизован
if (!$is_user_logged_in && !$is_login_page) {
    header('Location: /administration/login.php?msg=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="theme-color" content="#FAFAFA">
    <link rel="shortcut icon" href="/favicon/favicon.ico" />

    <title>
        <?php if (!isset($title)) {
            echo "Администрирование – Лапки и ушки";
        } else {
            echo "$title – Администрирование – Лапки и ушки";
        }
        ?>
    </title>
    <link href="/css/style.css" rel="stylesheet" />
</head>

<body>