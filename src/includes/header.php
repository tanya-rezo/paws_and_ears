<?php include './database.php'; ?>
<?php session_start(); ?>
<?php $conn = connect_db(); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="theme-color" content="#FAFAFA">
    <link rel="shortcut icon" href="favicon/favicon.ico" />

    <title>Лапки и ушки</title>
    <link href="./css/style.css" rel="stylesheet" />
</head>

<body>
    <?php
    /*     echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>'; */

    // складываем все переменные сессии (счётчики товаров в корзине)
    $cart_count = array_sum($_SESSION);
    ?>


    <form action="search.php">
        <nav class="navbar navbar-expand-lg navbar-light">

            <div class="container">
                <a href="index.php">
                    <span class="navbar-brand logo-space">
                        <img src="img/logo.svg">
                    </span>
                </a>

                <input type="text" class="form-control search-field" id="searchbar" name="q" placeholder="Поиск по сайту" value="<?php echo $_GET["q"]; ?>"></input>
                <button type="submit" id="send-btn" class="btn btn-primary">Искать</button>


                <a href="cart.php">
                    <img class="cart-icon" src="img/shopping_cart.svg"></img>
                </a>
                <a href="cart.php">
                    <div class="cart-counter vh-center"><?php echo $cart_count; ?></div>
                </a>
            </div>

        </nav>
    </form>