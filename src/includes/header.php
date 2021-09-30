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
                <a class="d-none d-lg-block" href="index.php">
                    <span class="navbar-brand logo-space">
                        <img src="img/logo.svg">
                    </span>
                </a>

                <div class="d-flex d-lg-none flex-nowrap justify-content-between w-100 mt-2">
                    <button class="hamburger hamburger--squeeze navbar-toggler hamburger-style collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                    <a href="index.php">
                        <img class="logo-space" src="img/logo.svg">
                    </a>
                    <div class="d-flex flex-row vh-center">
                        <a href="cart.php">
                            <img class="cart-icon" src="img/shopping_cart.svg"></img>
                        </a>
                        <a href="cart.php">
                            <div class="cart-counter vh-center"><?php echo $cart_count; ?></div>
                        </a>
                    </div>
                </div>

                <div class="d-flex d-lg-none input-group mb-3">
                    <input type="text" class="form-control search-field w-75" placeholder="Поиск по сайту" name="q" value="<?php echo $_GET["q"]; ?>"></input>
                    <div class="input-group-append">
                        <button class="form-control search-field" type="submit" id="send-btn"><img class="" src="img/pin.svg"></button>
                    </div>
                </div>

                <input type="text" class="d-none d-lg-block form-control search-field" id="searchbar" name="q" placeholder="Поиск по сайту" value="<?php echo $_GET["q"]; ?>"></input>
                <button type="submit" id="send-btn" class="d-none d-lg-block btn btn-primary">Искать</button>


                <a class="d-none d-lg-block" href="cart.php">
                    <img class="cart-icon" src="img/shopping_cart.svg"></img>
                </a>
                <a class="d-none d-lg-block" href="cart.php">
                    <div class="cart-counter vh-center"><?php echo $cart_count; ?></div>
                </a>

            </div>

        </nav>
    </form>