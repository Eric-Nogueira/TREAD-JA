<?php

namespace App\Controller\Pages;

use App\Session\Login;
use \App\Utils\View;

use \App\Model\Entity\Organization;
Class Sobre extends Page {
    public static function getSobre(){
        Login::requireLogin();
        $content = View::render('pages/sobre');

   return parent::getPage('Tread JA - Sobre', $content);
    }
}

?>