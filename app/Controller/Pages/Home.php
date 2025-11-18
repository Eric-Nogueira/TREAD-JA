<?php

namespace App\Controller\Pages;

use \App\Utils\View;

use \App\Model\Entity\Organization;
Class Home extends Page {
    public static function getHome(){
        $org = new Organization();



        $content = View::render('pages/home', 
        ['name'=> $org->name,
    'description' => $org->about]);

   return parent::getPage('Home', "<h1>Olá, mundo</h1>");
    }
}

?>