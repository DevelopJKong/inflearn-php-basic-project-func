<?php

function createUser($email, $password, $username)
{
    return execute('INSERT INTO users(email, password, username) VALUES(?, ? ,?)', $email, $password, $username);
}

function updateUser($id, $email, $password, $username)
{
    return execute('UPDATE users SET email = ?, password = ?, username = ? WHERE id = ?', $email, $password, $username, $id);
}