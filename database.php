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
        product.price
    FROM 
        product";
    
    return mysqli_query($conn,$query);
}

?>