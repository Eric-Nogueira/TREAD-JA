<?php

namespace App\Controller\Pages;

use \App\Utils\View;

use \App\Model\Entity\Organization;
Class Contato extends Page {
    public static function getContato(){
        $org = new Organization();



        $content = View::render('pages/sobre', 
        ['name'=> $org->name,
    'description' => $org->about]);

   return parent::getPage('Tread JA - Contato', "<h1>Contatos</h1>");
    }
}

?>