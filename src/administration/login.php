<?php include './includes/header.php'; ?>
<?php include_once '../database.php'; ?>

<div class="container main-container">
    <div class="mt-3 mb-1 vh-center">
        <img class="logo-space mr-0" src="../img/logo.svg">
    </div>
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">

            <form class="mb-4" action="./auth.php" method="POST">
                <div class="form-group">
                    <label for="name">Логин</label>
                    <input required type="text" class="form-control" id="login" name="login">
                </div>
                <div class="form-group">
                    <label for="name">Пароль</label>
                    <input required type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary admin-btn mt-2 w-100">Войти</button>
            </form>

            <?php if ($_GET["msg"] == 1) : ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Для просмотра данной странцы нужно авторизоваться!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <?php if ($_GET["msg"] == 2) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Неверный логин или пароль!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
        </div>
    </div>

</div>

<?php include '../includes/footer.php';
