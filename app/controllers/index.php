<?php

function index($page = 0)
{
    $posts = rows('SELECT * FROM posts ORDER BY id DESC LIMIT 3 OFFSET '.$page *3);
    return views('index',[
        'posts'=> transform($posts) ?: []
    ]);
}