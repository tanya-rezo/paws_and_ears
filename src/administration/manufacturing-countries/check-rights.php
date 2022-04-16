<?php
include '../admin-common.php';

if (!current_user_is_admin() && !current_user_is_manager()) {
    header('Location: /administration/index.php?access-denied=1');
    exit;
}
