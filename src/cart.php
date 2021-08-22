<?php include './includes/header.php'; ?>

<div class="container container-fill">
    <div class="row">
        <?php include './includes/menu.php'; ?>

        <div class="col-6">
            <div class="mb-4">
                <h2 class="d-inline mr-1">Корзина</h2>
                <span><?php echo $cart_count; ?> шт. товара</span>
            </div>

            <?php
            $total_cost = 0;
            foreach ($_SESSION as $product_id => $count) {
                // обрезаем имя переменной сессии чтобы получить id товара
                // "product_3" -> "3"
                $id = substr($product_id, 8);

                // получаем данные о продукте для корзины
                $product = mysqli_fetch_array(get_product_for_cart($conn, $id));

                // подсчитываем общую стоимость
                $total_cost = $total_cost + ($product["price"] * $count);

                echo "
                <div class='cart-item'>
                    <div class='cart-item-image-col'>
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
                                </div>
                                <div class='cart-item-price'>{$product["price"]} ₽</div>
                            </div>
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
                echo "<div class='flex-column-container mt-150px vh-center'>";
                echo "  <img src='img/cat-in-box.svg' class='empty-screen-cat'>";
                echo "  <h5 class='empty-screen-text mt-3'>В корзине ничего нет</h5>";
                echo "</div>";
            }

            ?>
        </div>

        <div class="col-3">
            <form action="/cart/make-order.php">

                <div class="checkout-box">
                    <h5>Итого: <?php echo $total_cost; ?> ₽</h5>
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
                        echo "<div class='mb-2 cart-error-text'>";
                        echo "  <span>Не заполнены обязательные поля</span>";
                        echo "</div>";
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