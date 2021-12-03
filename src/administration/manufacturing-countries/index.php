<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_manufacturing_countries_classes.php'; ?>

<div class="container main-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $manager = new ManufacturingCountriesManager();
            $all = $manager->getAll($conn);
            foreach ($all as $item) {
                echo "
                <tr>
                    <th scope='row'>{$item->id}</th>
                    <td>{$item->name}</td>
                    <td>
                        <a href='./edit.php'>Изменить</a>
                        <a href='./delete.php'>Удалить</a>
                    </td>
                </tr>
                ";
            }
            ?>

        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php';
