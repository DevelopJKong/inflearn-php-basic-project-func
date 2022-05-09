<?php

function user()
{
    if ($user = $_SESSION['user']) {
        return $userId == $user['id'];
    }
    return false;
}

function views($view, $vars = [])
{
    foreach ($vars as $name => $value) {
        $$name = $value;
    }
    return require_once dirname(__DIR__, 2) . '/resources/views/layouts/app.php';
}

function owner($id)
{
    ['user_id' => $userId] = first("SELECT * FROM posts WHERE id = ?", $id);
    if ($user = $_SESSION['user']) {
        return $userId == $user['id'];
    }
    return false;
}

function redirect($url)
{
    header("Location: {$url}");
    return http_response_code() == 302;
}

function reject($message = null)
{
    switch (gettype($message)) {
        case 'integer':
            http_response_code($message);
            return;
        case 'string':
            return header("Location: {$message}");
        default:
            return header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}

function matchs($path, $method = null)
{
    $is = ($_SERVER['PATH_INFO'] ?? '/') == $path;
    if ($method) {
        $is = $is && strtoupper($method) == $_SERVER['REQUEST_METHOD'];
    }
    return $is;
}

function verify($guards)
{
    foreach ($guards as [$path, $method]) {
        if (matchs($path, $method)) {
            $token = array_key_exists('token', $_REQUEST) ? filter_var($_REQUEST['token'], FILTER_SANITIZE_STRING) : null;
            if (hash_equals($token, $_SESSION['CSRF_TOKEN'])) {
                return true;
            }
            return false;
        }
    }
    return true;
}

function guard($guards)
{
    foreach ($guards as $path) {
        if (matchs($path)) {
            return $_SESSION['user'] ?: false;
        }
    }
    return true;
}

function requires($requires)
{
    if (count($requires) == count(array_filter($requires))) {
        return true;
    }
    return false;
}

function routes($routes)
{
    foreach ($routes as [$path, $method, $callbackString]) {
        [$file, $callback] = explode('.', $callbackString);
        if (matchs($path, $method)) {
            require_once dirname(__DIR__, 2) . "/app/controllers/{$file}.php";
            call_user_func($callback, ...array_values($_GET));
            return true;
        }
    }
    return false;
}

function config($configString)
{
    $configParts = explode('.', $configString);

    $config = include dirname(__DIR__, 2) . '/config/' . $configParts[0] . '.php';
    return count($configParts) > 1 ? $config[next($configParts)] : $config;
}