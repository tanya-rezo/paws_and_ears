<?php
session_start();

function current_user_is_admin()
{
    return $_SESSION['user_level'] == 1;
}

function current_user_is_manager()
{
    return $_SESSION['user_level'] == 2 || $_SESSION['user_level'] == 3;
}

function current_user_is_operator()
{
    return $_SESSION['user_level'] == 4;
}
