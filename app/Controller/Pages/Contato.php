<?php

namespace App\Controller\Pages;

use \App\Utils\View;

Class Contato extends Page {
    public static function getContato(){



        $content = View::render('pages/sobre', 
        []);

   return parent::getPage('Tread JA - Contato', "<h1>Contatos</h1>");
    }
}

?>