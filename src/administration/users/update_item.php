<?php include_once '../../database.php'; ?>
<?php include_once './_users_classes.php'; ?>
<?php

$is_edit = isset($_GET["id"]);

// получаем GET параметры
$id = $_GET["id"];
$login = $_GET["login"];
$password = $_GET["password"];
$role_id = $_GET["role"];

// чистим данные от SQL инъекций
settype($id, 'integer');
$login = mysqli_real_escape_string($conn, $login);
$password = mysqli_real_escape_string($conn, $password);
settype($role_id, 'integer');

// создаём объект и наполняем
$item = new User();
$item->id = $id;
$item->login = $login;
$item->password = $password;
$item->role = new Role();
$item->role->id = $role_id;

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
