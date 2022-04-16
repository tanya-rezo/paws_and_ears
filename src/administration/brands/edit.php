<?php
$title = "Бренды";
include '../includes/header.php';
?>
<?php include_once '../../database.php'; ?>
<?php include_once './_brands_classes.php'; ?>

<?php
$is_edit = isset($_GET["id"]);

if ($is_edit) {
    $id = $_GET["id"];
    settype($id, 'integer');

    $edit_item = new Brand();
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
                    <a href="./index.php">Бренды</a>
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
            <label for="name">Название</label>
            <input required type="text" class="form-control" id="name" name="name" value="<?php echo $edit_item->name ?>">
        </div>
        <?php if ($is_edit) : ?>
            <button type="submit" class="btn btn-primary admin-btn mt-2">Сохранить</button>
        <?php else : ?>
            <button type="submit" class="btn btn-primary admin-btn mt-2">Создать</button>
        <?php endif; ?>

    </form>
</div>

<?php include '../includes/footer.php';
