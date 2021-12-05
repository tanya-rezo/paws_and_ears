<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_categories_classes.php'; ?>

<div class="container main-container">
    <form action="./create_item.php">
        <div class="form-group">
            <label for="id">ID</label>
            <input readonly class="form-control" id="id" name="id">
        </div>
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="full-name">Полное название</label>
            <input type="text" class="form-control" id="full-name" name="full-name">
        </div>
        <div class="form-group">
            <label for="pet-type">Вид живтного</label>
            <select class="form-control" id="pet-type" name="pet-type">
                <?php
                $manager = new PetTypeManager();
                $manager->getAll($conn);
                $all = $manager->getAll($conn);
                foreach ($all as $item) {
                    echo "
                    <option value='{$item->id}'>{$item->name}</option>
                ";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="url">URL-адрес</label>
            <!-- <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">lapki-ushki.ru/catalog.php?category=</span>
            </div> -->
            <input type="text" class="form-control" id="url" name="url">
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>