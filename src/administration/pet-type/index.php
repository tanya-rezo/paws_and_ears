<?php include './check-rights.php'; ?>
<?php
$title = "Виды животных";
include '../includes/header.php';
?>
<?php include_once '../../database.php'; ?>
<?php include_once './_pet_type_classes.php'; ?>

<div class="container main-container">
    <div class="row">
        <div class="col-12">
            <div class="flex-row-container mb-3">
                <div class="lite-font-weight flex-row-container admin-breadcrumbs">
                    <h6>
                        <a href="../index.php">Администрирование</a>
                    </h6>
                    <img class="breadcrumbs-delimiter" src="/img/breadcrumb-arrow.svg"></img>
                    <h6>Виды животных</h6>
                </div>
                <a class="btn btn-primary admin-btn mt-40px" href="./create.php">Создать</a>
            </div>
        </div>
    </div>

    <?php include '../includes/crud_messages.php'; ?>

    <table class="table table-hover mb-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Название для акций</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $manager = new PetTypeManager();
            $all = $manager->getAll($conn);
            foreach ($all as $item) {
                echo "
                <tr>
                    <th scope='row'>{$item->id}</th>
                    <td>{$item->name}</td>
                    <td>{$item->sale_name}</td>
                    <td>
                        <a href='./edit.php?id={$item->id}'>Изменить</a>
                        <a href='./delete.php?id={$item->id}'>Удалить</a>
                    </td>
                </tr>
                ";
            }
            ?>

        </tbody>
    </table>
</div>

<?php include '../includes/footer.php';
