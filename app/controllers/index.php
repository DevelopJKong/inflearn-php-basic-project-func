<?php

function index($page = 0)
{
    return views('index', [
        'posts' => getPosts(filter_var($page, FILTER_VALIDATE_INT), 3),
    ]);
}