<?php

require __DIR__ . '/vendor/autoload.php';



use \App\Http\Response;
use \App\Http\Router;
use \App\Utils\View;

define('URL', 'http://localhost:1911');

// DEFINE O VALOR DE VARIÁVEIS PADRÕES E COMUNS A TODAS AS PÁGINAS
View::init([
    'URL'=> URL
]);

$obRouter = new Router(URL);

include __DIR__ .'/routes/pages.php';

$obRouter->run()->sendResponse();