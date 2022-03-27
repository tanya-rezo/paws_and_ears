<?php include_once '../../database.php'; ?>
<?php include_once './_clients_classes.php'; ?>
<?php

$is_edit = isset($_GET["id"]);

// получаем GET параметры
$id = $_GET["id"];
$first_name = $_GET["first-name"];
$last_name = $_GET["last-name"];
$middle_name = $_GET["middle-name"];
$phone = $_GET["phone"];

// чистим данные от SQL инъекций
settype($id, 'integer');
$first_name = mysqli_real_escape_string($conn, $first_name);
$last_name = mysqli_real_escape_string($conn, $last_name);
$middle_name = mysqli_real_escape_string($conn, $middle_name);
$phone = mysqli_real_escape_string($conn, $phone);

// создаём объект и наполняем
$item = new Client();
$item->id = $id;
$item->first_name = $first_name;
$item->last_name = $last_name;
$item->middle_name = $middle_name;
$item->phone = $phone;

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
