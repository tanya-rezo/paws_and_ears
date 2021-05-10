<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Создаём подключение
function connect_db()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "paws_and_ears";

    
    $conn = new mysqli($servername, $username, $password, $db);
    // Проверяем на ошибку
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    return $conn;
}

// Разрываем подключение
function disconnect_db($conn) {
    mysqli_close($conn);
}

// Получаем акционные товары из БД
function get_actions($conn) {
    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price,
        product.image
    FROM 
        product";
    
    return mysqli_query($conn,$query);
}

// Получаем товар по id
function get_product($conn, $id) {
    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price, 
        product.image, 
        product.description, 
        category.name as category, 
        pet_type.name as pet_type, 
        brand.name as brand, 
        manufacturer_country.name as manufacturer
    FROM 
        product
    LEFT JOIN
        category
        ON category.id = product.category_id
    LEFT JOIN
        pet_type
        ON pet_type.id = category.pet_type_id
    LEFT JOIN
        brand
        ON brand.id = product.brand_id
    LEFT JOIN
        manufacturer_country
        ON manufacturer_country.id = product.manufacturer_country_id
    WHERE product.id = " . $id;
    
    return mysqli_query($conn,$query);
}

?>