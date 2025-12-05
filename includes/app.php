<?php

require __DIR__ . '/../vendor/autoload.php';

use \App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;

Environment::load(__DIR__ . '/../');

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

define('URL', getenv('URL'));

// DEFINE O VALOR DE VARIÁVEIS PADRÕES E COMUNS A TODAS AS PÁGINAS
// TÁ DANDO ERRO; BAGUNÇA A RENDERIZAÇÃO DAS VIEWS
View::init([
    'URL'=> URL
]);