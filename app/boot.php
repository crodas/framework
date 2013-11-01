<?php

require __DIR__ . "/../vendor/autoload.php";

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

$service = new \ServiceProvider\Composer(
    __DIR__ . "/configs/app.yml",
    'Service',
    __DIR__ . "/../tmp/services.php"
);

if (Service::Get('devel')) {
    $run     = new Run;
    $handler = new PrettyPageHandler;
    $run->pushHandler($handler);
    $run->register();
}

