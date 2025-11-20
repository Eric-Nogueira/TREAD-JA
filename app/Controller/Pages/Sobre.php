<?php

namespace App\Controller\Pages;

use \App\Utils\View;

use \App\Model\Entity\Organization;
Class Sobre extends Page {
    public static function getSobre(){
        $org = new Organization();



        $content = View::render('pages/sobre', 
        ['name'=> $org->name,
    'description' => $org->about,
'content' => "<img src='https://media.giphy.com/media/3o7aD2saalBwwftBIY/giphy.gif' alt='Gif animado de boas-vindas'/>"]);

   return parent::getPage('Tread JA - Sobre', "<h1>Sobre</h1>");
    }
}

?>