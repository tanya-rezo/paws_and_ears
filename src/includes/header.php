<?php include_once './database.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="theme-color" content="#FAFAFA">
    <link rel="shortcut icon" href="/favicon/favicon.ico" />

    <title>
        <?php if (!isset($title)) {
            echo "Лапки и ушки";
        } else {
            echo "$title - Лапки и ушки";
        }
        ?>
    </title>

    <link href="/css/style.css" rel="stylesheet" />
</head>

<body>