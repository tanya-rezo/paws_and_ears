<?php include './check-rights.php'; ?>
<?php include_once '../../database.php'; ?>
<?php include_once './_products_classes.php'; ?>
<?php

$is_edit = isset($_POST["id"]);

// получаем GET параметры
$id = $_POST["id"];
$name = $_POST["name"];
$price = $_POST["price"];
$image = $_POST["image"];
$description = $_POST["description"];
$category_id = $_POST["category"];
$brand_id = $_POST["brand"];
$manufacturer_country_id = $_POST["manufacturer-country"];
$is_sale = $_POST["is-sale"];
$sale_price = $_POST["sale-price"];

// чистим данные от SQL инъекций
settype($id, 'integer');
$name = mysqli_real_escape_string($conn, $name);
settype($price, 'double');
$image = mysqli_real_escape_string($conn, $image);
$description = mysqli_real_escape_string($conn, $description);
settype($category_id, 'integer');
settype($brand_id, 'integer');
settype($manufacturer_country_id, 'integer');
$is_sale = $is_sale == "1";
settype($sale_price, 'double');

//Генерация уникальной строки заданной длины для имени файла
function uniqidReal($lenght)
{
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("Нет подходящей криптографической функции");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}

if (is_uploaded_file($_FILES['image']['tmp_name'])) {
    // формируем имена файлов и пути
    $target_dir = "../../products/";
    $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
    $image_filename = uniqidReal(15) . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_filename;

    // валидация файла
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== true) {
            echo "Файл не является картинкой";
            exit;
        }
    }
    if ($_FILES["image"]["size"] > 1500000) {
        echo "Превышен размер файла";
        exit;
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "В качестве файла изображения допустимы форматы JPG, JPEG, PNG и GIF";
        exit;
    }
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Ошибка при загрузке файла";
        exit;
    }

    // удаление старой картинки, если мы обновляем существующий товар
    if (isset($_POST["id"])) {
        $old_item = new Product();
        $old_item->id = $id;
        $old_item->refresh($conn);
        unlink($target_dir . $old_item->image);
    }
} else {
    $old_item = new Product();
    $old_item->id = $id;
    $old_item->refresh($conn);
    $image_filename = $old_item->image;
}

// создаём объект и наполняем
$item = new Product();
$item->id = $id;
$item->name = $name;
$item->price = $price;
$item->image = $image_filename;
$item->description = $description;
$item->is_sale = $is_sale;
$item->sale_price = $sale_price;
$item->category = new Category();
$item->category->id = $category_id;
$item->brand = new Brand();
$item->brand->id = $brand_id;
$item->manufacturer_country = new ManufacturingCountry();
$item->manufacturer_country->id = $manufacturer_country_id;

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
