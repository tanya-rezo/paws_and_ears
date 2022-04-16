<?php include './check-rights.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_manufacturing_countries_classes.php'; ?>
<?php

$is_edit = isset($_GET["id"]);

// получаем GET параметры
$id = $_GET["id"];
$name = $_GET["name"];

// чистим данные от SQL инъекций
settype($id, 'integer');
$name = mysqli_real_escape_string($conn, $name);

// создаём объект и наполняем
$item = new ManufacturingCountry();
$item->id = $id;
$item->name = $name;

if ($is_edit) {
    // обновляем в БД
    $item->save($conn);
    header('Location: ./index.php?save=1');
} else {
    // создаём в БД
    $item->create($conn);
    header('Location: ./index.php?create=1');
}

disconnect_db($conn);
