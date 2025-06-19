<?php

spl_autoload_register(function(string $className) {

    $classFilename = $className . ".php";
    $classPath = __DIR__ . '/../classes/' . $classFilename;

    if(file_exists($classPath)) {
        require_once $classPath;
    }
});