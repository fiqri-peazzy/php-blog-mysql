<?php


function userOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id'])) {
        $_SESSION['message'] = "Anda Harus Login terlebih dahulu";
        $_SESSION['type'] = "error";
        header('Location:' . BASE_URL . $redirect);
        exit(0);
    }
}

function adminOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id']) || empty($_SESSION['admin'])) {
        $_SESSION['message'] = "Anda Harus Login Sebagai Superuser";
        $_SESSION['type'] = "error";
        header('Location:' . BASE_URL . $redirect);
        exit(0);
    }
}

function guestOnly($redirect = '/index.php')
{
    if (isset($_SESSION['id'])) {
        header('Location:' . BASE_URL . $redirect);
        exit(0);
    }
}