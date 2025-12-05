<?php

namespace App\Controller\Pages;

use App\Session\Login;
use \App\Utils\View;

Class Contato extends Page {
    public static function getContato(){
        Login::requireLogin();

        $content = View::render('pages/contato', 
        []);

   return parent::getPage('Tread JA - Contato', $content);
    }
}

?>