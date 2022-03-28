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

try {
    $item->delete($conn);
    header('Location: ./index.php?delete-success=1');
} catch (Exception $e) {
    header('Location: ./index.php?delete-error=1');
} finally {
    disconnect_db($conn);
}
