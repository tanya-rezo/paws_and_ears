<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_categories_classes.php'; ?>

<?php
$is_edit = isset($_GET["id"]);
//$is_create = !$is_edit;

if ($is_edit) {
    $id = $_GET["id"];
    settype($id, 'integer');

    $edit_item = new Category();
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
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $edit_item->display_name ?>">
        </div>
        <div class="form-group">
            <label for="full-name">Полное название</label>
            <input type="text" class="form-control" id="full-name" name="full-name" value="<?php echo $edit_item->full_name ?>">
        </div>
        <div class="form-group">
            <label for="pet-type">Вид живтного</label>
            <select class="form-control" id="pet-type" name="pet-type">
                <?php
                $manager = new PetTypeManager();
                $all = $manager->getAll($conn);
                $selected_item_id = $edit_item->pet_type->id;

                foreach ($all as $item) {
                    if ($is_edit && $item->id == $selected_item_id) {
                        // если режим редактирования и текущий элемент выбран
                        echo "<option selected value='{$item->id}'>{$item->name}</option>";
                    } else {
                        // просто элемент выпадающего списка
                        echo "<option value='{$item->id}'>{$item->name}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="url">URL-адрес</label>
            <!-- <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">lapki-ushki.ru/catalog.php?category=</span>
            </div> -->
            <input type="text" class="form-control" id="url" name="url" value="<?php echo $edit_item->url_name ?>">
        </div>
        <?php if ($is_edit) : ?>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        <?php else : ?>
            <button type="submit" class="btn btn-primary">Создать</button>
        <?php endif; ?>

    </form>
</div>