<?php include './includes/header.php'; ?>

<div class="container container-fill">

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-12 col-lg-9">
            <div class="lite-font-weight flex-row-container breadcrumbs">
                <h6>
                    <a href="index.php">Главная</a>
                </h6>
                <img class="breadcrumbs-delimiter" src="img/breadcrumb-arrow.svg"></img>
                <h6>Корзина</h6>
            </div>
        </div>
    </div>

    <div class="row">
        <?php include './includes/menu.php'; ?>

        <div class="col-12 col-lg-6">
            <div class="mb-4">
                <h3 class="d-inline mr-1">Корзина</h3>
                <span><?php echo $cart_count; ?> шт. товара</span>
            </div>

            <?php
            $total_cost = 0;
            $total_disount = 0;
            foreach ($_SESSION as $product_id => $count) {
                // обрезаем имя переменной сессии чтобы получить id товара
                // "product_3" -> "3"
                $id = substr($product_id, 8);

                // получаем данные о продукте для корзины
                $product = mysqli_fetch_array(get_product_for_cart($conn, $id));

                // подсчитываем общую скидку
                if ($product["is_sale"] == "1") {
                    $total_disount = $total_disount + (($product["price"] - $product["sale_price"]) * $count);
                }

                // подсчитываем общую стоимость
                if ($product["is_sale"] == "1") {
                    $total_cost = $total_cost + ($product["sale_price"] * $count);
                } else {
                    $total_cost = $total_cost + ($product["price"] * $count);
                }

                echo "
                <div class='cart-item'>
                    <div class='cart-item-image-col vh-center'>
                        <a href='product.php?id={$product["id"]}'>
                            <img class='cart-item-image' src='products/{$product["image"]}'></img>
                        </a>
                    </div>
                    <div class='cart-item-main-col'>
                        <div class='cart-item-main-box'>
                            <a href='product.php?id={$product["id"]}'>
                                <div class='cart-item-name'>{$product["name"]}</div>
                            </a>
                            <div class='flex-row-container'>
                                <div class='flex-row-container'>
                                    <a href='/cart/minus.php?product={$product["id"]}'>
                                        <div class='cart-counter vh-center'>–</div>
                                    </a>
                                    <div class='cart-item-counter-text'>$count</div>
                                    <a href='/cart/plus.php?product={$product["id"]}'>
                                        <div class='cart-counter vh-center'>+</div>
                                    </a>
                                </div>";

                if ($product["is_sale"] == "1") {
                    echo "      <div class='cart-item-price'>{$product["sale_price"]} ₽</div>
                                <div class='cart-item-price cart-item-old-price'>{$product["price"]} ₽</div>";
                } else {
                    echo "      <div class='cart-item-price'>{$product["price"]} ₽</div>";
                }

                echo "      </div>
                        </div>
                    </div>
                    <div class='cart-item-delete-col vh-center'>
                        <a href='/cart/delete.php?product={$product["id"]}'>
                            <img src='img/delete.svg'></img>
                        </a>
                    </div>
                </div>
                ";
            }

            if ($cart_count == 0) {
                echo "
                <div class='flex-column-container mt-150px vh-center'>
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
                    if ($total_disount == 0) {
                        echo "
                        <h5>Итого: {$total_cost} ₽</h5>";
                    } else {
                        echo "
                        <h5 class='mb-1'>Итого: {$total_cost} ₽</h5>
                        <h6 class='cart-discount-text'>Скидка: {$total_disount} ₽</h6>";
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
                <div class="mt-3 vh-center">
                    <a href="/cart/clear.php">Очистить корзину</a>
                </div>
            </form>
        </div>


    </div>

</div>


<?php include './includes/footer.php'; ?>