<?php

namespace App\Controller\Pages;

use \App\Utils\View;

Class Home extends Page {
    public static function getHome(){

        $content = View::render('pages/home', 
        []);

   return parent::getPage('Tread JA - Início', $content);
    }
}

?>