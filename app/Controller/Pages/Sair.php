<?php

namespace App\Controller\Pages;

use \App\Session\Login;
use \App\Utils\View;

class Sair extends Page{
    public static function getSair(){
        Login::requireLogin();

        $content = View::render('pages/sair', 
        []);

   return parent::getPage('Tread JA - Sair', $content);
    }

    public static function handleSair($request){
        $postVars = $request->getPostVars();

        if($postVars['getout'] == 's'){
            Login::logout();
        }
        else {
            header('location: /');
            exit;
        }

    }

}