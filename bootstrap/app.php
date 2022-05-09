<?php

assert_options(ASSERT_BAIL, true);

//정확히 무슨 코드인지 모르겠다
foreach (['lib', 'services'] as $dir) {
    $includePath = dirname(__DIR__) . "/app/{$dir}/";
    foreach (scandir($includePath) as $file) {
        if (fnmatch('*.php', $file)) {
            require_once $includePath . $file;
        }
    }
}
$provders = [
    'error',
    'database',
    'session',
    'middleware',
    'route',
];
foreach ($provders as $file) {
    assert(require_once dirname(__DIR__) . "/app/providers/{$file}.php");
}