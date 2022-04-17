<?php
$title = "Корзина";
include './includes/header.php';
?>
<?php include './includes/top-bar.php'; ?>
<?php include './includes/menu.php'; ?>
<?php include './cart/_cart.php'; ?>

<div class="container menu-container" style="display: none;">
    <?php include './includes/menu-content-mobile.php'; ?>
</div>

<div class="container main-container">

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-12 col-lg-9">
            <div class="lite-font-weight flex-row-container breadcrumbs">
                <h6>
                    <a href="/index.php">Главная</a>
                </h6>
                <img class="breadcrumbs-delimiter" src="img/breadcrumb-arrow.svg"></img>
                <h6>Корзина</h6>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="d-none d-lg-block col-3 catalog-container">
            <?php include './includes/menu-content-desktop.php'; ?>
        </div>

        <div class="col-12 col-lg-6">
            <div class="mb-4">
                <h3 class="d-inline mr-1">Корзина</h3>
                <span><?php echo $cart_count; ?> шт. товара</span>
            </div>

            <?php
            $cart = new Cart($_SESSION);
            $cart->load($conn);

            foreach ($cart->items as $product) {
                echo "
                <div class='cart-item'>
                    <div class='cart-item-image-col vh-center'>
                        <a href='product.php?id={$product->id}'>
                            <img class='cart-item-image' src='products/{$product->image}'></img>
                        </a>
                    </div>
                    <div class='cart-item-main-col'>
                        <div class='cart-item-main-box'>
                            <a href='product.php?id={$product->id}'>
                                <div class='cart-item-name box'>
                                    <p>{$product->name}</p>
                                </div>
                            </a>
                            <div class='flex-row-container xs-cart-content'>
                                <div class='flex-row-container'>
                                    <div class='flex-row-container'>
                                        <a href='/cart/minus.php?product={$product->id}'>
                                            <div class='cart-counter vh-center'>–</div>
                                        </a>
                                        <div class='cart-item-counter-text'>$product->count</div>
                                        <a href='/cart/plus.php?product={$product->id}'>
                                            <div class='cart-counter vh-center'>+</div>
                                        </a>
                                    </div>";

                if ($product->is_sale == true) {
                    echo "      <div class='cart-item-price'>{$product->sale_price} ₽</div>
                                <div class='cart-item-price cart-item-old-price'>{$product->price} ₽</div>";
                } else {
                    echo "      <div class='cart-item-price'>{$product->price} ₽</div>";
                }
                echo "
                                </div>
                                <div class='d-block d-lg-none cart-item-delete-col vh-center'>
                                    <a href='/cart/delete.php?product={$product->id}'>
                                        <img src='img/delete.svg'></img>
                                    </a>
                                </div>
                            </div>
                      
                        </div>
                    </div>
                    <div class='d-none d-lg-block cart-item-delete-col vh-center'>
                        <a href='/cart/delete.php?product={$product->id}'>
                            <img src='img/delete.svg'></img>
                        </a>
                    </div>
                </div>
                ";
            }

            if ($cart_count == 0) {
                echo "
                <div class='flex-column-container space-cat-in-box-img vh-center mb-3'>
                    <img src='img/cat-in-box.svg' class='empty-screen-cat'>
                    <h5 class='empty-screen-text mt-3'>В корзине ничего нет</h5>
                </div>";
            }

            ?>
        </div>

        <div class="col-12 col-lg-3">
            <form action="/cart/make-order.php">

                <div class="checkout-box">

                    <?php
                    if ($cart->total_discount == 0) {
                        echo "
                        <h5>Итого: {$cart->total_cost} ₽</h5>";
                    } else {
                        echo "
                        <h5 class='mb-1'>Итого: {$cart->total_cost} ₽</h5>
                        <h6 class='cart-discount-text'>Скидка: {$cart->total_discount} ₽</h6>";
                    }
                    ?>
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" name="firstName" placeholder="Имя*" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" name="lastName" placeholder="Фамилия*" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" name="middleName" placeholder="Отчество">
                    </div>
                    <div class="form-group mb-2">
                        <input type="tel" class="form-control" name="phoneNumber" placeholder="Телефон*" required>
                    </div>
                    <div class="form-group mb-2">
                        <textarea class="form-control" name="comment" rows="2" placeholder="Комментарий"></textarea>
                    </div>

                    <?php
                    if (isset($_GET["error"])) {
                        echo "
                        <div class='mb-2 cart-error-text'>
                            <span>Не заполнены обязательные поля</span>
                        </div>";
                    }
                    ?>

                    <button <?php echo $cart_count == 0 ? "disabled" : ""; ?> type="submit" class="btn checkout-btn">Оформить заказ</a>
                </div>
                <div class="mt-3 mb-3 vh-center">
                    <a href="/cart/clear.php">Очистить корзину</a>
                </div>
            </form>
        </div>


    </div>

</div>


<?php include './includes/footer.php'; ?>