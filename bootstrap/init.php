<?php

require_once __DIR__ . '/autoload.php';

session_start();

const ROOT_PATH = __DIR__ . '/..';

function imagesPath(string $path = ""): string {
    return ROOT_PATH . "/imgs/" . $path;
}