<!-- <% var data={ title: "Подробности о товаре" , }; %> -->
<?php include './includes/header.php'; ?>

<div class="container container-fill">
    <div class="row">
        <?php include './includes/menu.php'; ?>

        <div class="col-9">
            <h2 class="mb-4">Мышь мягкая 12,5 см</h2>
            <div class="row">
                <div class="col-7">
                    <img class="details-product-image" src="img/mouse_big.png" />
                </div>
                <div class="col-5 flex-column-container">
                    <div class="details-headers">
                        <div><span>Артикул</span></div>
                        <div><span>Категория</span></div>
                        <div><span>Наличие</span></div>
                        <div><span>Страна</span></div>
                    </div>

                    <div class="details-values">
                        <div><span>23</span></div>
                        <div><span>Игрушки для кошек</span></div>
                        <div><span>В наличии</span></div>
                        <div><span>Россия</span></div>
                    </div>

                    <div class="container-fill"></div>

                    <div class="position-relative mb-3">
                        <div class="details-headers"><span>Цена</span></div>
                        <div class="details-price-text">500 ₽</div>
                    </div>

                    <a role="button" class="btn btn-primary details-add-to-card-btn" href="#">Добавить в
                        корзину</a>
                </div>
            </div>
            <div class="row mt-4 text-justify">
                <div class="col-12">Новые муссы MEALFEEL MONOPROTEIN – это консервы премиум
                    класса,
                    произведённые
                    из охлаждённого мяса высочайшего класса.
                    Монопротеиновые муссы MEALFEEL служат основой гипоаллергенной диеты у кошек. В состав
                    консервов входит только один белок животного происхождения, что легко позволяет
                    исключить из
                    рациона ингредиенты, вызывающие аллергию. Как и все консервы под брендом MEALFEEL,
                    монопротеиновые муссы являются полноценным кормом со сбалансированным составом,
                    включающим
                    незаменимые минеральные вещества и витамины. Муссы приготовлены щадящим способом, на
                    пару,
                    сохраняя максимум полезных веществ мясных ингредиентов. Мусс имеет нежнейшую текстуру, и
                    кошка очень легко может его слизывать своим шероховатым языком, не прикладывая больших
                    усилий.
                </div>
            </div>
        </div>

    </div>
</div>

<?php include './includes/footer.php'; ?>