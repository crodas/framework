<?php

require __DIR__ . "/../vendor/autoload.php";

$service = new \ServiceProvider\Composer(
    __DIR__ . "/configs/app.yml",
    'Service',
    __DIR__ . "/../tmp/services.php"
);
