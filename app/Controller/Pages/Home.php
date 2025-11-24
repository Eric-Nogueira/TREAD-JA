<?php

namespace App\Controller\Pages;

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
                    'vaga.empresa' => $objVaga['empresa_cnpj'] ? : 'Vazio'
                ]);
            }
        }

        return $itens;
    }
    public static function getHome(){

        $content = View::render('pages/home', 
        [
            'itensVaga' => self::getVagaItens()
        ]);

   return parent::getPage('Tread JA - Início', $content);
    }
}

?>

