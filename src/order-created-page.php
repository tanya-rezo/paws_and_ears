<?php include './includes/header.php'; ?>
<?php include './includes/top-bar.php'; ?>
<?php include './includes/menu.php'; ?>

<div class="container menu-container" style="display: none;">
    <?php include './includes/menu-content-mobile.php'; ?>
</div>

<div class="container main-container">
    <div class="vh-center flex-column-container mt-150px">
        <img src="img/callcenter-cat.svg"></img>
        <h3 class="mt-3">Ваш заказ принят</h3>
        <span class="text-center">В ближайшее время с Вами свяжется оператор для подтверждения.</span>
        <a role="button" class="btn btn-primary mt-3" href="/order-status.php?id=<?= $_GET['guid'] ?>">Перейти к отслеживанию</a>
    </div>
</div>

<?php include './includes/footer.php'; ?>