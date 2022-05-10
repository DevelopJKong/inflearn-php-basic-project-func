<?php

//문제
//error => C:\xampp\htdocs\infPhpBoard_Fun\app\lib\database.php on line 56
function index($page = 0)
{
    return views('index', [
        'posts' => getPosts(filter_var($page, FILTER_VALIDATE_INT), 3),
    ]);
}