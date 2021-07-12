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
function disconnect_db($conn)
{
    mysqli_close($conn);
}

// Получаем рандомные 6 акционных товаров из БД по виду питомца
function get_on_sale_top_6($conn, $pet_type)
{
    $query = "
    SELECT
        product.id, 
        product.name, 
        product.price,
        product.image
    FROM 
        product
    LEFT JOIN
        category ON category.id = product.category_id
    WHERE
        product.is_sale = 1
        AND
		category.pet_type_id = " . $pet_type . "
        ORDER BY RAND()
        LIMIT 6";

    return mysqli_query($conn, $query);
}

// Получаем акционные товары из БД по виду питомца
function get_on_sale_by_pet_type($conn, $pet_type)
{
    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price,
        product.image
    FROM 
        product
    LEFT JOIN
        category ON category.id = product.category_id
    WHERE
        product.is_sale = 1
        AND
		category.pet_type_id = " . $pet_type;

    return mysqli_query($conn, $query);
}

// Получаем товары из БД по категории
function get_products($conn, $category)
{
    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price,
        product.image
    FROM 
        product
    WHERE
    product.category_id = " . $category;

    return mysqli_query($conn, $query);
}

// Получаем имя категории и вид питомца
function get_category($conn, $category)
{
    $query = "
    SELECT 
        category.name as category,
        pet_type.name as pet_type
    FROM 
        category
    LEFT JOIN
        pet_type ON pet_type.id = category.pet_type_id
    WHERE
        category.id = " . $category;

    return mysqli_query($conn, $query);
}

// Получаем товар по id
function get_product($conn, $id)
{
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

    return mysqli_query($conn, $query);
}

// Получаем товар по id для корзины
function get_product_for_cart($conn, $id)
{
    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price, 
        product.image
    FROM 
        product
    WHERE product.id = " . $id;

    return mysqli_query($conn, $query);
}

// Поиск товаров
function search_product($conn, $search)
{
    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price,
        product.image
    FROM 
        product
    WHERE product.name LIKE '%" . $search . "%'";

    return mysqli_query($conn, $query);
}

// Сохранение информации о покупателе
function create_client($conn, $firstName, $lastName, $middleName, $phoneNumber)
{
    $query = "
    INSERT INTO client (id, first_name, last_name, middle_name, phone) 
    VALUES (NULL, '" . $firstName . "', '" . $lastName . "', '" . $middleName . "', '" . $phoneNumber . "')";

    $conn->query($query);
}

// Создание заказа
function create_order($conn, $comment, $clientId)
{
    $query = "
    INSERT INTO placed_order (id, comment, client_id) 
    VALUES (NULL, '" . $comment . "', '" . $clientId . "')";

    $conn->query($query);
}

// Добавление товара в заказ
function create_order_item($conn, $orderId, $productId, $count)
{
    $query = "
    INSERT INTO `placed_order_item` (`placed_order_id`, `product_id`, `count`) 
    VALUES ('" . $orderId . "', '" . $productId . "', '" . $count . "')";

    $conn->query($query);
}
