<?php include_once '../../database.php'; ?>
<?php include_once './_categories_classes.php'; ?>
<?php

// получаем GET параметры
$name = $_GET["name"];
$full_name = $_GET["full-name"];
$pet_type_id = $_GET["pet-type"];
$url = $_GET["url"];

// чистим данные от SQL инъекций
settype($pet_type_id, 'integer');
$name = mysqli_real_escape_string($conn, $name);
$full_name = mysqli_real_escape_string($conn, $full_name);
$url = mysqli_real_escape_string($conn, $url);

// создаём объект и наполняем
$item = new Category();
$item->display_name = $name;
$item->full_name = $full_name;
$item->url_name = $url;
$item->pet_type = new PetType();
$item->pet_type->id = $pet_type_id;

// сохраняем в БД
$item->create($conn);

header('Location: ./index.php');
disconnect_db($conn);
