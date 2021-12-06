<?php include_once '../../database.php'; ?>
<?php include_once './_products_classes.php'; ?>
<?php

$is_edit = isset($_GET["id"]);

// получаем GET параметры
$id = $_GET["id"];
$name = $_GET["name"];
$price = $_GET["price"];
$image = $_GET["image"];
$description = $_GET["description"];
$category_id = $_GET["category"];
$brand_id = $_GET["brand"];
$manufacturer_country_id = $_GET["manufacturer-country"];
$is_sale = $_GET["is-sale"];
$sale_price = $_GET["sale-price"];

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

// создаём объект и наполняем
$item = new Product();
$item->id = $id;
$item->name = $name;
$item->price = $price;
$item->image = $image;
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
} else {
    // создаём в БД
    $item->create($conn);
}

header('Location: ./index.php');
disconnect_db($conn);
