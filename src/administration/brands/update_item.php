<?php include_once '../../database.php'; ?>
<?php include_once './_brands_classes.php'; ?>
<?php

$is_edit = isset($_GET["id"]);

// получаем GET параметры
$id = $_GET["id"];
$name = $_GET["name"];

// чистим данные от SQL инъекций
settype($id, 'integer');
$name = mysqli_real_escape_string($conn, $name);

// создаём объект и наполняем
$item = new Brand();
$item->id = $id;
$item->name = $name;

if ($is_edit) {
    // обновляем в БД
    $item->save($conn);
} else {
    // создаём в БД
    $item->create($conn);
}

header('Location: ./index.php');
disconnect_db($conn);
