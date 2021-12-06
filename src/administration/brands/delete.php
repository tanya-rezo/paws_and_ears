<?php include_once '../../database.php'; ?>
<?php include_once './_brands_classes.php'; ?>
<?php

// получаем GET параметры
$id = $_GET["id"];

// чистим данные от SQL инъекций
settype($id, 'integer');

// создаём объект и наполняем
$item = new Brand();
$item->id = $id;

$item->delete($conn);

header('Location: ./index.php');
disconnect_db($conn);
