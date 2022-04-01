<?php
$title = "Пользователи";
include '../includes/header.php';
?>
<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_users_classes.php'; ?>
<?php include_once '../roles/_roles_classes.php'; ?>

<?php
$is_edit = isset($_GET["id"]);

if ($is_edit) {
    $id = $_GET["id"];
    settype($id, 'integer');

    $edit_item = new User();
    $edit_item->id = $id;
    $edit_item->refresh($conn);
}
?>

<div class="container main-container">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="lite-font-weight flex-row-container admin-breadcrumbs">
                <h6>
                    <a href="../index.php">Администрирование</a>
                </h6>
                <img class="breadcrumbs-delimiter" src="/img/breadcrumb-arrow.svg"></img>
                <h6>
                    <a href="./index.php">Пользователи</a>
                </h6>
            </div>
        </div>
    </div>

    <form action="./update_item.php">
        <?php if ($is_edit) : ?>
            <div class="form-group">
                <label for="id">ID</label>
                <input readonly class="form-control" id="id" name="id" value="<?php echo $edit_item->id ?>">
            </div>
        <?php endif ?>
        <div class="form-group">
            <label for="name">Логин</label>
            <input required type="text" class="form-control" id="login" name="login" value="<?php echo $edit_item->login ?>">
        </div>
        <div class="form-group">
            <label for="name">Пароль</label>
            <input required type="text" class="form-control" id="password" name="password" value="<?php echo $edit_item->password ?>">
        </div>
        <div class="form-group">
            <label for="name">Роль</label>
            <?php
            $manager = new RoleManager();
            $all = $manager->getAll($conn);
            $selected_item_id = $edit_item->role->id;

            foreach ($all as $item) {
                if ($is_edit && $item->id == $selected_item_id) {
                    echo "
                <div class='form-check mb-1'>
                    <input class='form-check-input' type='radio' name='role' id='role' value='{$item->id}'checked>
                    <label class='form-check-label' for='role'>
                    {$item->name}<br>
                    <p class='font-weight-light'>{$item->description}</p>
                    </label>
                </div>";
                } else {
                    echo "
                <div class='form-check mb-1'>
                    <input class='form-check-input' type='radio' name='role' id='role' value='{$item->id}'>
                    <label class='form-check-label' for='role'>
                    {$item->name}<br>
                    <p class='font-weight-light'>{$item->description}</p>
                    </label>
                </div>";
                }
            }
            ?>
        </div>
        <?php if ($is_edit) : ?>
            <button type="submit" class="btn btn-primary admin-btn mt-2">Сохранить</button>
        <?php else : ?>
            <button type="submit" class="btn btn-primary admin-btn mt-2">Создать</button>
        <?php endif; ?>

    </form>
</div>

<?php include '../../includes/footer.php';
