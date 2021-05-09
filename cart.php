<!-- <% var data={ title: "Корзина" , }; %> -->
<?php include './includes/header.php'; ?>

<div class="container container-fill">
    <div class="row">
        <?php include './includes/menu.php'; ?>

        <div class="col-6">
            <div class="mb-4">
                <h2 class="d-inline mr-1">Корзина</h2>
                <span>2 товара</span>
            </div>

            <div class="cart-item">
                <div class="cart-item-image-col">
                    <a href="product.php">
                        <img class="cart-item-image" src="img/mouse.png"></img>
                    </a>
                </div>
                <div class="cart-item-main-col">
                    <div class="cart-item-main-box">
                        <a href="product.php">
                            <div class="cart-item-name">
                                Мышь мягкая мягкая мягкая мягкая мягкая мягкая мягкая мягкая мягкая мягкая
                                мягкая 12,5 см
                            </div>
                        </a>
                        <div class="flex-row-container">
                            <div class="flex-row-container">
                                <a href="#">
                                    <div class="cart-counter vh-center">–</div>
                                </a>
                                <div class="cart-item-counter-text">5</div>
                                <a href="#">
                                    <div class="cart-counter vh-center">+</div>
                                </a>
                            </div>
                            <div class="cart-item-price">299 ₽</div>
                        </div>
                    </div>
                </div>
                <div class="cart-item-delete-col vh-center">
                    <a href="#">
                        <img class="" src="img/delete.svg"></img>
                    </a>
                </div>
            </div>

            <div class="cart-item">
                <div class="cart-item-image-col">
                    <img class="cart-item-image" src="img/mouse.png"></img>
                </div>
                <div class="cart-item-main-col">
                    <div class="cart-item-main-box">
                        <div class="cart-item-name">
                            Мышь мягкая мягкая мягкая 12,5 см
                        </div>
                        <div class="flex-row-container">
                            <div class="flex-row-container">
                                <a href="#">
                                    <div class="cart-counter vh-center">–</div>
                                </a>
                                <div class="cart-item-counter-text">5</div>
                                <a href="#">
                                    <div class="cart-counter vh-center">+</div>
                                </a>
                            </div>
                            <div class="cart-item-price">299 ₽</div>
                        </div>
                    </div>
                </div>
                <div class="cart-item-delete-col vh-center">
                    <a href="#">
                        <img class="" src="img/delete.svg"></img>
                    </a>
                </div>
            </div>

        </div>

        <div class="col-3">
            <div class="checkout-box">
                <h5>Итого: 5002 Р</h5>
                <div class="form-group mb-2">
                    <input type="text" class="form-control" id="firstName" placeholder="Имя">
                </div>
                <div class="form-group mb-2">
                    <input type="text" class="form-control" id="lastName" placeholder="Фамилия">
                </div>
                <div class="form-group mb-2">
                    <input type="text" class="form-control" id="middleName" placeholder="Отчество">
                </div>
                <div class="form-group mb-2">
                    <input type="tel" class="form-control" id="phoneNumber" placeholder="Телефон">
                </div>
                <div class="form-group mb-2">
                    <textarea class="form-control" id="comment" rows="2" placeholder="Комментарий"></textarea>
                </div>
                <a role="button" class="btn checkout-btn">Оформить заказ</a>
            </div>
            <div class="mt-3 vh-center">
                <a href="#">Очистить корзину</a>
            </div>
        </div>
    </div>

</div>

<?php include './includes/footer.php'; ?>