<?php

use Notoj\Dir;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;


require __DIR__ . "/app/boot.php";


$reader = new Dir(__DIR__ . "/app/cli");
$annotations = $reader->getAnnotations();


$console = new Application();

foreach ($annotations->get('Cli') as $annotation) {
    $zargs = [];
    foreach ($annotation->get('Arg') as $args) {
        $args = $args['args']; 
        $name = current($args);
        $flag = InputArgument::REQUIRED;
        $hint = $name;

        $zargs[] = new InputArgument($name, $flag, $hint);
    }

    foreach ($annotation->get('Cli') as $args) {
        $name = current($args['args'] ?: []);
        $console->register($name)
            ->setDefinition($zargs)
            ->setCode(function($input, $output) use ($annotation) {
                require $annotation['file'];
                if (empty($annotation['class'])) {
                    $callback = $annotation['function'];
                } else {
                    $class = $annotation['class'];
                    $callback = [new $class, $annotation['function']];
                }
                call_user_func($annotation['function'], $input, $output);
            });
    }
}

$console->run();
