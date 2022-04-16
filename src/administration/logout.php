<?php
session_start();

unset($_SESSION['user_login'], $_SESSION['user_level']);

header('Location: /administration/login.php?msg=1');
