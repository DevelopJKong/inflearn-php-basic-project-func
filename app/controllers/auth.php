<?php

//작동
function showLoginForm()
{
    return views('auth', [
        'requestUrl' => '/auth/login',
    ]);
}

//작동
function login()
{
    $args = filter_input_array(INPUT_POST, [
        'email' => FILTER_VALIDATE_EMAIL | FILTER_SANITIZE_EMAIL,
        'password' => FILTER_DEFAULT,
    ]);

    return signIn(...array_values($args)) ? redirect('/') : reject();
}

//작동
function logout()
{
    return signOut() ? redirect('/') : reject();
}