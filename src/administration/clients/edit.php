<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_clients_classes.php'; ?>

<?php
$is_edit = isset($_GET["id"]);

if ($is_edit) {
    $id = $_GET["id"];
    settype($id, 'integer');

    $edit_item = new Client();
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
            <label for="first-name">Имя</label>
            <input required type="text" class="form-control" id="first-name" name="first-name" value="<?php echo $edit_item->first_name ?>">
        </div>
        <div class="form-group">
            <label for="last-name">Фамилия</label>
            <input required type="text" class="form-control" id="last-name" name="last-name" value="<?php echo $edit_item->last_name ?>">
        </div>
        <div class="form-group">
            <label for="middle-name">Отчество</label>
            <input type="text" class="form-control" id="middle-name" name="middle-name" value="<?php echo $edit_item->middle_name ?>">
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input required type="tel" class="form-control" id="phone" name="phone" value="<?php echo $edit_item->phone ?>">
        </div>
        <?php if ($is_edit) : ?>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        <?php else : ?>
            <button type="submit" class="btn btn-primary">Создать</button>
        <?php endif; ?>

    </form>
</div>