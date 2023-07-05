<?php



include(ROOT_PATH . "/app/databases/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");

$admin_users = selectAll('users');

$errors = array();
$id = '';
$username = '';
$admin = '';
$email = '';
$password = '';
$confpassword = '';

function loginUser($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'You are now logged in';
    $_SESSION['type'] = 'success';

    if ($_SESSION['admin']) {
        header('Location: ' . BASE_URL . '/admin/dashboard.php');
    } else {
        header('Location: ' . BASE_URL . '/index.php');
    }

    exit();
}

if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
    $errors = validateUser($_POST);
    if (count($errors) === 0) {
        unset($_POST['register-btn'], $_POST['confpassword'], $_POST['create-admin']);

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create('users', $_POST);
            $_SESSION['message'] = 'admin user created succesfully';
            $_SESSION['type'] = 'success';
            header('Location: ' . BASE_URL . '/admin/users/index.php');
            exit();
        } else {
            $_POST['admin'] = 0;
            $user_id = create('users', $_POST);
            $user = selectOne('users', ['id' => $user_id]);
            // Login User into
            loginUser($user);
        }
    } else {
        $username = $_POST['username'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];
    }
}

if (isset($_POST['update-user'])) {
    adminOnly();
    $errors = validateUser($_POST);
    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['confpassword'], $_POST['update-user'], $_POST['id']);

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        $user_id = update('users', $id, $_POST);
        $_SESSION['message'] = 'admin user created succesfully';
        $_SESSION['type'] = 'success';
        header('Location: ' . BASE_URL . '/admin/users/index.php');
        exit();
    } else {
        $username = $_POST['username'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confpassword = $_POST['confpassword'];
    }
}

if (isset($_GET['id'])) {
    $user = selectOne('users', ['id' => $_GET['id']]);
    $id = $user['id'];
    $username = $user['username'];
    $admin = $user['admin'];
    $email = $user['email'];
}


if (isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
        $user = selectOne('users', ['username' => $_POST['username']]);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            // login User and redirect
            loginUser($user);
        } else {
            array_push($errors, 'Wrong Credentials');
        }
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
}

if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = deleteF('users', $_GET['delete_id']);
    $_SESSION['message'] = 'admin user deleted';
    $_SESSION['type'] = 'success';
    header('Location: ' . BASE_URL . '/admin/users/index.php');
    exit();
}