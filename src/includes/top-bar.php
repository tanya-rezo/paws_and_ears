<?php

// складываем все переменные сессии (счётчики товаров в корзине)
$cart_count = array_sum($_SESSION);
?>

<form action="search.php">
    <nav class="navbar navbar-expand-lg navbar-light">

        <div class="container">
            <a class="d-none d-lg-block" href="/index.php">
                <span class="navbar-brand logo-space">
                    <img src="/img/logo.svg">
                </span>
            </a>

            <div class="d-flex d-lg-none flex-nowrap justify-content-between w-100 mt-2">
                <button class="hamburger hamburger--squeeze hamburger-style collapsed" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
                <a href="/index.php">
                    <img class="logo-space" src="/img/logo.svg">
                </a>
                <div class="d-flex flex-row vh-center">
                    <a href="cart.php">
                        <img class="cart-icon" src="/img/shopping_cart.svg"></img>
                    </a>
                    <a href="cart.php">
                        <div class="cart-counter vh-center"><?php echo $cart_count; ?></div>
                    </a>
                </div>
            </div>
            <div class="flex-row-container w-100 mb-4 mt-4">
                <div class="flex-column-container w-100">
                    <input type="text" class="form-control search-field" id="searchbar" name="q" placeholder="Поиск по сайту" value="<?php echo $_GET["q"]; ?>"></input>
                    <input type="image" class="d-lg-none search-icon" src="/img/search_magnifier.svg">
                </div>
                <button type="submit" id="send-btn" class="d-none d-lg-block btn btn-primary send-btn">Искать</button>
                <div class="d-flex flex-row vh-center">
                    <a class="d-none d-lg-block" href="cart.php">
                        <img class="cart-icon" src="/img/shopping_cart.svg"></img>
                    </a>
                    <a class="d-none d-lg-block" href="cart.php">
                        <div class="cart-counter vh-center"><?php echo $cart_count; ?></div>
                    </a>
                </div>

            </div>

    </nav>
</form>