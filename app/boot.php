<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/define.php";

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

mb_internal_Encoding("UTF-8");

$service = new \ServiceProvider\Composer(
    CONFIG,
    'Service',
    SERVICE,
    array(SERVICES)
);

if (Service::Get('devel') && PHP_SAPI !== 'cli') {
    $run     = new Run;
    $handler = new PrettyPageHandler;
    $run->pushHandler($handler);
    $run->register();
}

