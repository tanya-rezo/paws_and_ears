<?php include '../includes/header.php'; ?>
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
            <button type="submit" class="btn btn-primary">Сохранить</button>
        <?php else : ?>
            <button type="submit" class="btn btn-primary">Создать</button>
        <?php endif; ?>

    </form>
</div>