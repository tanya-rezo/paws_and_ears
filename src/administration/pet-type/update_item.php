<?php include './check-rights.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_pet_type_classes.php'; ?>
<?php

$is_edit = isset($_GET["id"]);

// получаем GET параметры
$id = $_GET["id"];
$name = $_GET["name"];
$sale_name = $_GET["sale-name"];

// чистим данные от SQL инъекций
settype($id, 'integer');
$name = mysqli_real_escape_string($conn, $name);
$sale_name = mysqli_real_escape_string($conn, $sale_name);

// создаём объект и наполняем
$item = new PetType();
$item->id = $id;
$item->name = $name;
$item->sale_name = $sale_name;

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
