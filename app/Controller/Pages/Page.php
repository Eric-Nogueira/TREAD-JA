<?php

namespace App\Controller\Pages;
use \App\Session\Login;

use \App\Utils\View;
Class Page {

    private static function getHeader(){
        return View::render('pages/header');
    }

    private static function getFooter(){
        return View::render('pages/footer');
    }
    public static function getPage($title, $content) {
        return View::render('pages/page', 
        ['content'=> $content,
        'title' => $title,
        'header' => self::getHeader(),
        'footer' => self::getFooter()]

    );

    
    }
}

?>