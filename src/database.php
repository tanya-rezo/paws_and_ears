<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Создаём подключение
function connect_db()
{
    /*$config = parse_ini_file("php.ini"); 

    $servername = $config["servername"];
    $username = $config["username"];
    $password = $config["password"];
    $db = $config["db"];*/
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "paws_and_ears";

    $conn = new mysqli($servername, $username, $password, $db);
    // Проверяем на ошибку
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    mysqli_query($conn, "SET NAMES 'utf8'");

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
    settype($pet_type, 'integer');

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
		category.pet_type_id = '$pet_type'
        ORDER BY RAND()
        LIMIT 6";

    return mysqli_query($conn, $query);
}

// Получаем акционные товары из БД по виду питомца
function get_on_sale_by_pet_type($conn, $pet_type_id)
{
    settype($pet_type_id, 'integer');

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
		category.pet_type_id = $pet_type_id";

    return mysqli_query($conn, $query);
}

// Получаем товары из БД по id категории
function get_products($conn, $category_id)
{
    settype($category_id, 'integer');

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
    category.id = '$category_id'
    ORDER BY is_sale DESC";

    return mysqli_query($conn, $query);
}

// Получаем full_name категории для каждого питомца по url_name категории
function get_category($conn, $category_url_name)
{
    $category_url_name = mysqli_real_escape_string($conn, $category_url_name);

    $query = "
    SELECT
        category.id as id,
        category.full_name as category
    FROM 
        category
    WHERE
        category.url_name = '$category_url_name'";

    return mysqli_query($conn, $query);
}

// Получаем имя питомца по его id
function get_pet_sale_name($conn, $pet_type_id)
{
    settype($pet_type_id, 'integer');

    $query = "
    SELECT 
        pet_type.sale_name as pet_type
    FROM 
        pet_type
    WHERE
        pet_type.id = $pet_type_id";

    return mysqli_query($conn, $query);
}

// Получаем товар по id
function get_product($conn, $id)
{
    settype($id, 'integer');

    $query = "
    SELECT 
        product.id, 
        product.name, 
        product.price,
        product.sale_price,
        product.is_sale, 
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
    WHERE product.id = $id";

    return mysqli_query($conn, $query);
}

// Получаем товар по id для корзины
function get_product_for_cart($conn, $id)
{
    settype($id, 'integer');

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
    WHERE product.id = $id";

    return mysqli_query($conn, $query);
}

// Поиск товаров
function search_product($conn, $search)
{
    $search = mysqli_real_escape_string($conn, $search);

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
    WHERE product.name LIKE '%$search%'
    ORDER BY is_sale DESC";

    return mysqli_query($conn, $query);
}

// Сохранение информации о покупателе
function create_client($conn, $firstName, $lastName, $middleName, $phoneNumber)
{
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $middleName = mysqli_real_escape_string($conn, $middleName);
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);

    $query = "
    INSERT INTO client (id, first_name, last_name, middle_name, phone) 
    VALUES (NULL, '$firstName', '$lastName', '$middleName', '$phoneNumber')";

    $conn->query($query);
}

// Создание заказа
function create_order($conn, $comment, $clientId, $total_cost, $total_discount, $total_product_count)
{
    $comment = mysqli_real_escape_string($conn, $comment);
    settype($clientId, 'integer');

    $query = "
    INSERT INTO placed_order (id, comment, client_id, total_cost, total_discount, total_product_count, guid) 
    VALUES (NULL, '$comment', '$clientId', '$total_cost', '$total_discount', '$total_product_count', UUID())";

    $conn->query($query);
}

// Добавление товара в заказ
function create_order_item($conn, $orderId, $productId, $count, $cost_per_item, $discount_per_item)
{
    settype($orderId, 'integer');
    settype($productId, 'integer');
    settype($count, 'integer');
    settype($cost_per_item, 'double');
    settype($discount_per_item, 'double');

    $query = "
    INSERT INTO `placed_order_item` (`placed_order_id`, `product_id`, `count`, `cost_per_item`, `discount_per_item`) 
    VALUES ('$orderId', '$productId', '$count', '$cost_per_item', '$discount_per_item')";

    $conn->query($query);
}

// Получение ID и название катеории для меню
function get_menu($conn)
{
    $query = "
    SELECT 
        category.id, 
        category.url_name, 
        category.display_name,
        category.pet_type_id
    FROM 
        category";

    return mysqli_query($conn, $query);
}

// Получение количества столбцов в таблицах для главной страницы админки
function admin_get_count_columns($conn)
{
    $query = "
    SELECT 
        (SELECT COUNT(*) FROM pet_type) AS count_pet_type,
        (SELECT COUNT(*) FROM category) AS count_category,
        (SELECT COUNT(*) FROM product) AS count_product,
        (SELECT COUNT(*) FROM brand) AS count_brand,
        (SELECT COUNT(*) FROM manufacturer_country) AS count_manufacturer_country,
        (SELECT COUNT(*) FROM placed_order) AS count_placed_order,
        (SELECT COUNT(*) FROM client) AS count_client,
        (SELECT COUNT(*) FROM user) AS count_user";

    return mysqli_query($conn, $query);
}

function get_order($conn, $order_id)
{
    settype($order_id, 'integer');

    $query = "
        SELECT 
            placed_order.id as placed_order_id,
            placed_order.total_product_count as placed_order_total_product_count,
            placed_order.total_cost as placed_order_total_cost,
            placed_order.order_date as placed_order_order_date,
            order_status.id as order_status_id,
            order_status.name as order_status_name,
            order_status.message as order_status_message
        FROM 
            placed_order
        LEFT JOIN
            order_status ON order_status.id = placed_order.order_status_id
        WHERE
            placed_order.id = $order_id";

    return mysqli_query($conn, $query);
}

function get_order_items($conn, $order_id)
{
    settype($order_id, 'integer');

    $query = "
        SELECT 
            placed_order_item.cost_per_item as placed_order_item_cost_per_item,
            placed_order_item.discount_per_item as placed_order_item_discount_per_item,
            placed_order_item.count as placed_order_item_count,
            product.id as product_id,
            product.name as product_name, 
            product.price as product_price,
            product.image as product_image,
            product.description as product_description,
            product.is_sale as product_is_sale,
            product.sale_price as product_sale_price
        FROM 
            placed_order_item
        LEFT JOIN
            product ON product.id = placed_order_item.product_id
        WHERE 
            placed_order_item.placed_order_id = $order_id";

    return mysqli_query($conn, $query);
}

function get_order_guid($conn, $orderId)
{
    settype($orderId, 'integer');

    $query = "
        SELECT 
            placed_order.guid as placed_order_guid
        FROM 
            placed_order
        WHERE 
            placed_order.id = $orderId";

    return mysqli_query($conn, $query);
}

function get_order_id($conn, $orderGuid)
{
    $query = "
        SELECT 
            placed_order.id as placed_order_id
        FROM 
            placed_order
        WHERE 
            placed_order.guid = '$orderGuid'";

    return mysqli_query($conn, $query);
}

function get_user_by_login($conn, $login)
{
    $query = "
        SELECT 
            user.id, 
            user.login, 
            user.password, 
            user.role_id 
        FROM 
            user 
        WHERE
            user.login = '$login'";

    return mysqli_query($conn, $query);
}

// Cоздаём подключение к БД
$conn = connect_db();
