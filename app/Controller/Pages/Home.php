<?php

namespace App\Controller\Pages;

use App\Session\Login;
use \App\Utils\View;
use \App\Model\Entity\Vaga as VagaModel;

Class Home extends Page {

    private static function getVagaItens(){

        $itens = '';

        $vagas = VagaModel::getVagas(null, 'ID_vaga DESC');

        if (is_array($vagas)) {
            foreach ($vagas as $objVaga) {
                $itens .= View::render('pages/vagas/item', [
                    'vaga.id' => $objVaga['ID_vaga'] ? : 'XXXX',
                    'vaga.titulo' => $objVaga['titulo'] ? : 'Vazio',
                    'vaga.empresa' => $objVaga['empresa_nome'] ? : 'Vazio'
                ]);
            }
        }

        return $itens;
    }

    public static function getSelfVagas(){
        $itens = '';

        $vagas = VagaModel::getVagas('empresa_cnpj = "' . $_SESSION["user"]['cpf'] . '"', 'ID_vaga DESC');

        if (is_array($vagas)) {
            foreach ($vagas as $objVaga) {
                $itens .= View::render('pages/vagas/item', [
                    'vaga.id' => $objVaga['ID_vaga'] ? : 'XXXX',
                    'vaga.titulo' => $objVaga['titulo'] ? : 'Vazio',
                    'vaga.empresa' => $objVaga['empresa_nome'] ? : 'Vazio'
                ]);
            }
        }

        return $itens;
    }

    public static function getHome(){
        Login::requireLogin();

        if($_SESSION["user"]['type'] == 'Jovem'){
        $content = View::render('pages/home', 
        [
            'itensVaga' => self::getVagaItens()
        ]);
        }

        if($_SESSION["user"]['type'] == 'Empresa'){
        $content = View::render('pages/homeE', 
        [
            'itensVaga' => self::getSelfVagas()
        ]);
        }

        

   return parent::getPage('Tread JA - Início', $content);
    }
}

?>

