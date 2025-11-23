<?php

namespace App\Controller\Pages;

use \App\Utils\View;
Class Perfil extends Page {
    public static function getPerfil(){

        $content = View::render('pages/perfil', 
        []);

   return parent::getPage('Tread JA - Perfil', $content);
    }
}

?>