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
        product.sale_price,
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
function get_on_sale_by_pet_type($conn, $pet_type_id)
{
    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price,
        product.sale_price,
        product.image
    FROM 
        product
    LEFT JOIN
        category ON category.id = product.category_id
    WHERE
        product.is_sale = 1
        AND
		category.pet_type_id = " . $pet_type_id;

    return mysqli_query($conn, $query);
}

// Получаем товары из БД по id категории
function get_products($conn, $category_id)
{
    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price,
        product.sale_price,
        product.is_sale,
        product.image
    FROM 
        product
    LEFT JOIN
        category
        ON category.id = product.category_id
    WHERE
    category.id = '" . $category_id . "'
    ORDER BY is_sale DESC";

    return mysqli_query($conn, $query);
}

// Получаем full_name категории для каждого питомца по url_name категории
function get_category($conn, $category_url_name)
{
    $query = "
    SELECT
        category.id as id,
        category.full_name as category
    FROM 
        category
    WHERE
        category.url_name = '" . $category_url_name . "'";

    return mysqli_query($conn, $query);
}

// Получаем имя питомца по его id
function get_pet_sale_name($conn, $pet_type_id)
{
    $query = "
    SELECT 
        pet_type.sale_name as pet_type
    FROM 
        pet_type
    WHERE
        pet_type.id = " . $pet_type_id;

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
        category.full_name as category_full_name,
        category.url_name as category_url_name, 
        brand.name as brand, 
        manufacturer_country.name as manufacturer
    FROM 
        product
    LEFT JOIN
        category
        ON category.id = product.category_id
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
        product.sale_price,
        product.is_sale,
        product.image
    FROM 
        product
    WHERE product.name LIKE '%" . $search . "%'
    ORDER BY is_sale DESC";

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
