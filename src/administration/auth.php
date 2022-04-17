<?php include_once '../database.php';
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

$login = mysqli_real_escape_string($conn, $login);
$password = mysqli_real_escape_string($conn, $password);

$user = mysqli_fetch_array(get_user_by_login($conn, $login));

if (!isset($user)) {
    header('Location: /administration/login.php?msg=2');
    disconnect_db($conn);
    exit;
}

if (password_verify($password, $user['password'])) {
    $user_level = $user['role_id'];
    settype($user_level, 'integer');

    $_SESSION['user_login'] = $login;
    $_SESSION['user_level'] = $user_level;

    header('Location: /administration/index.php');
} else {
    header('Location: /administration/login.php?msg=2');
}

disconnect_db($conn);
