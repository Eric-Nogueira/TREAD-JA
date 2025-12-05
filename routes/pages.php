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

$obRouter->get('/perfil', [
    function ($idPagina) {
        return new Response(200, Pages\Perfil::getPerfil());
    }
]);

$obRouter->get('/vagas/{id}', [
    function ($id) {
        return new Response(200, Pages\VagaDetail::getVagaDetail($id));
    }
]);

$obRouter->get('/editar/{id}', [
    function ($id) {
        return new Response(200, Pages\EditarVaga::GetEditVaga($id));
    }
]);

$obRouter->post('/editar/{id}', [
    function ($id) {
        return new Response(200, Pages\EditarVaga::EditVaga($id));
    }
]);

$obRouter->post('/vagas/{id}', [
    function ($id) {
        return new Response(200, Pages\VagaDetail::CreateCandidatura($id));
    }
]);

$obRouter->get('/jainfos/10365741566', [
    function ($cpf) {
        return new Response(200, Pages\Infos::getInfo($cpf));
    }
]);

$obRouter->post('/jainfos/10365741566', [
    function ($request) {
        return new Response(200, Pages\Infos::handleInfo($request));
    }
]);

$obRouter->get('/login/ja', [
    function () {
        return new Response(200, Pages\LoginJ::getLogin());
    }
]);

$obRouter->post('/login/ja', [
    function ($request) {
        return new Response(200, Pages\LoginJ::handleLogin($request));
    }
]);

$obRouter->get('/cadastrar/ja', [
    function () {
        return new Response(200, Pages\CadastrarJ::getCadastrar());
    }
]);

$obRouter->post('/cadastrar/ja', [
    function ($request) {
        return new Response(200, Pages\CadastrarJ::handleCadastrar($request));
    }
]);

$obRouter->get('/login/empresa', [
    function () {
        return new Response(200, Pages\LoginE::getLogin());
    }
]);

$obRouter->post('/login/empresa', [
    function ($request) {
        return new Response(200, Pages\LoginE::handleLogin($request));
    }
]);

$obRouter->get('/editarperfil', [
    function () {
        return new Response(200, Pages\EditarPerfil::getEdit());
    }
]);

$obRouter->post('/editarperfil', [
    function ($request) {
        return new Response(200, Pages\EditarPerfil::handleEdit($request));
    }
]);

$obRouter->get('/cadastrar/empresa', [
    function () {
        return new Response(200, Pages\CadastrarE::getCadastrar());
    }
]);
$obRouter->post('/cadastrar/empresa', [
    function ($request) {
        return new Response(200, Pages\CadastrarE::handleCadastrar($request));
    }
]);

$obRouter->get('/sair', [
    function () {
        return new Response(200, Pages\Sair::getSair());
    }
]);

$obRouter->post('/sair', [
    function ($request) {
        return new Response(200, Pages\Sair::handleSair($request));
    }
]);

$obRouter->get('/newVaga', [
    function () {
        return new Response(200, Pages\NewVaga::getNewVaga());
    }
]);

$obRouter->post('/newVaga', [
    function ($request) {
        return new Response(200, Pages\NewVaga::handleNewVaga($request));
    }
]);

$obRouter->get('/taylorSwift', [
    function(){
        return header('location: https://www.cnnbrasil.com.br/entretenimento/com-jatinho-taylor-swift-e-a-celebridade-que-mais-emite-co2-diz-estudo/');
    }
]);

$obRouter->get('/taylor', [
    function(){
        return header('location: https://youtu.be/6TAPqXkZW_I?list=RD6TAPqXkZW_I');
    }
]);

