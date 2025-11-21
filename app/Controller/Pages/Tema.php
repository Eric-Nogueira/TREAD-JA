<?php

namespace App\Controller\Pages;

use \App\Utils\View;

use \App\Model\Entity\Organization;
Class Tema extends Page {
    public static function getTema(){

        $content = View::render('pages/tema');

   return parent::getPage('Tread JA - Tema', $content);
    }
}

?>