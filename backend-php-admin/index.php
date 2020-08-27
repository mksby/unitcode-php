<?php

namespace App;

use App\Db\Connection;

spl_autoload_register(function ($class_name) {
    $class = implode('\\', array_slice(explode('\\', $class_name), 1));
    $replace = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    include __DIR__ . DIRECTORY_SEPARATOR . strtolower($replace) . '.php';
});

if ($_FILES['csv']) {
    new Import(
        Connection::getInstance()->getConnection(),
        new Redirect(),
        $_FILES['csv']['tmp_name']
    );
} else {
    if (isset($argv[1])) {
        new Import(
            Connection::getInstance()->getConnection(),
            new Terminal(),
            $argv[1]
        );
    } else {
        echo 'path to a csv file is not provided';
    }
}
