<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_products_classes.php'; ?>

<?php
$is_edit = isset($_GET["id"]);

if ($is_edit) {
    $id = $_GET["id"];
    settype($id, 'integer');

    $edit_item = new Product();
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
                    <a href="./index.php">Товары</a>
                </h6>
            </div>
        </div>
    </div>

    <form action="./update_item.php" method="post" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="price">Цена</label>
            <input required type="number" class="form-control" id="price" name="price" value="<?php echo $edit_item->price ?>">
        </div>
        <div class="form-group">
            <label for="image">Картинка</label>
            <?php if ($is_edit) : ?>
                <img class="admin-product-image-preview d-block" src="/products/<?php echo $edit_item->image ?>">
            <?php endif ?>
            <input <?php echo ($is_edit ? '' : 'required') ?> type="file" class="form-control form-group-file-input" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="description">Комментарий</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $edit_item->description ?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Категория</label>
            <select class="form-control" id="category" name="category">
                <?php
                $manager = new CategoryManager();
                $all = $manager->getAll($conn);
                $selected_item_id = $edit_item->category->id;

                foreach ($all as $item) {
                    if ($is_edit && $item->id == $selected_item_id) {
                        echo "<option selected value='{$item->id}'>{$item->full_name}</option>";
                    } else {
                        echo "<option value='{$item->id}'>{$item->full_name}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="brand">Бренд</label>
            <select class="form-control" id="brand" name="brand">
                <?php
                $manager = new BrandManager();
                $all = $manager->getAll($conn);
                $selected_item_id = $edit_item->brand->id;

                foreach ($all as $item) {
                    if ($is_edit && $item->id == $selected_item_id) {
                        echo "<option selected value='{$item->id}'>{$item->name}</option>";
                    } else {
                        echo "<option value='{$item->id}'>{$item->name}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="manufacturer-country">Страна</label>
            <select class="form-control" id="manufacturer-country" name="manufacturer-country">
                <?php
                $manager = new ManufacturingCountriesManager();
                $all = $manager->getAll($conn);
                $selected_item_id = $edit_item->manufacturer_country->id;

                foreach ($all as $item) {
                    if ($is_edit && $item->id == $selected_item_id) {
                        echo "<option selected value='{$item->id}'>{$item->name}</option>";
                    } else {
                        echo "<option value='{$item->id}'>{$item->name}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="manufacturer-country">Наличие скидки</label>
            <select class="form-control" id="is-sale" name="is-sale">
                <?php if ($edit_item->is_sale) : ?>
                    <option selected value="1">Да</option>
                    <option value="0">Нет</option>
                <?php else : ?>
                    <option value="1">Да</option>
                    <option selected value="0">Нет</option>
                <?php endif ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sale-price">Цена по скидке</label>
            <input required type="number" class="form-control" id="sale-price" name="sale-price" value="<?php echo $edit_item->sale_price ?>">
        </div>
        <?php if ($is_edit) : ?>
            <button type="submit" class="btn btn-primary admin-btn mt-2 mb-4">Сохранить</button>
        <?php else : ?>
            <button type="submit" class="btn btn-primary admin-btn mt-2 mb-4">Создать</button>
        <?php endif; ?>

    </form>
</div>

<?php include '../../includes/footer.php';
