<?php

namespace App\Controller\Pages;

use App\Http\Request;
use App\Session\Login;
use \App\Utils\View;
use \App\Model\Entity\Vaga as VagaModel;

class NewVaga extends Page{

    public static function getNewVaga(){
        Login::requireLogin();

        if($_SESSION["user"]['type'] == 'Jovem'){
        header('location: /');
        }

        if($_SESSION["user"]['type'] == 'Empresa'){
        $content = View::render('pages/vagas/newvaga', 
        [
            'return' => ''
        ]);
        }

        

   return parent::getPage('Nova vaga', $content);
    }

    public static function handleNewVaga(Request $request){
        Login::requireLogin();
        $vaga = new VagaModel();
        $postVars = $request->getPostVars();

        $titulo = $postVars['titulo'];
        $jornada = $postVars['jornada'];
        $descricao = $postVars['desc'];
        $requisitos = $postVars['requisitos'];
        $cnpj = $_SESSION["user"]['cpf'];

        VagaModel::insertVaga($titulo, $descricao, $jornada, $requisitos, $cnpj);

        $content = View::render('pages/vagas/newvaga', 
        [
            'return' => '<p class="success">Vaga cadastrada com sucesso</p>'
        ]);
        return parent::getPage('Nova vaga', $content);
    }

}