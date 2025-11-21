<?php

use \App\Controller\Pages;
use \App\Http\Response;

$obRouter->get('/', [
    function () {
        return new Response(200, Pages\Home::getHome());
    }
]);

$obRouter->get('/sobre', [
    function () {
        return new Response(200, Pages\Sobre::getSobre());
    }
]);

$obRouter->get('/contato', [
    function ($idPagina) {
        return new Response(200, Pages\Contato::getContato());
    }
]);

$obRouter->get('/tema', [
    function ($idPagina) {
        return new Response(200, Pages\Tema::getTema());
    }
]);