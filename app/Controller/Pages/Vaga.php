<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Vaga as VagaModel;

use \App\Model\Entity\Organization;
Class Vaga extends Page {
    public static function getVaga(){
        
        $content = View::render('pages/vagas');

   return parent::getPage('Tread JA - Vagas', $content);
    }

    public static function insertVaga($request){
        $postVars = $request->getPostVars();

        $vaga = new VagaModel;
        $vaga->titulo = $postVars['titulo'];
        $vaga->descricao = $postVars['descricao'];
        $vaga->CNPJempresa = $postVars['CNPJempresa'];
        $vaga->requisitos = $postVars['requisitos'];
        $vaga->jornadaDeTrabalho = $postVars['jornadaTrabalho'];

        // Aqui você pode adicionar a lógica para salvar a vaga no banco de dados

        $vaga->cadastrar();

        return self::getVaga();
    }
}

?>