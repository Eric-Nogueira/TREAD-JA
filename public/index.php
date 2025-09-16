<?php

require "../bootstrap.php";
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/classes/Uri.php';
require __DIR__ . '/../core/Controller.php';

use core\Controller;

try {
    $controller = new Controller();
    $controller = $controller->load();
    dd($controller);
} catch (\Exception $e) {
    dd($e->getMessage());
}

?>