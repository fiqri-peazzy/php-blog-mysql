<?php

function validateUser($user)

{

    $errors = array();
    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['email'])) {
        array_push($errors, 'email is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'password is required');
    }


    if ($user['password'] !== $user['confpassword']) {
        array_push($errors, 'password did not match');
    }

    // $existingUser = selectOne('users', ['email' => $user['email']]);
    // if ($existingUser) {
    //     array_push($errors, 'Email Already Exist');
    // }
    $existinguser = selectOne('users', ['email' => $user['email']]);
    if ($existinguser) {

        if (isset($user['update-user']) && $existinguser['id'] != $user['id']) {
            array_push($errors, 'Email Already Exist');
        }

        if (isset($user['create-admin'])) {
            array_push($errors, 'Email Already Exist');
        }
    }
    return $errors;
}

function validateLogin($user)

{

    $errors = array();
    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'password is required');
    }

    return $errors;
}