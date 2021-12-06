<?php include '../includes/header.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_clients_classes.php'; ?>

<div class="container main-container">
    <a class="btn btn-primary" href="./create.php">Создать</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Отчество</th>
                <th scope="col">Телефон</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $manager = new ClientManager();
            $all = $manager->getAll($conn);
            foreach ($all as $item) {
                echo "
                <tr>
                    <th scope='row'>{$item->id}</th>
                    <td>{$item->first_name}</td>
                    <td>{$item->last_name}</td>
                    <td>{$item->middle_name}</td>
                    <td>{$item->phone}</td>
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

<?php include '../../includes/footer.php';
