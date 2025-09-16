<?php

namespace core;

use app\classes\Uri;

class Controller {

    private $uri;

    public function __construct(){
        $this->uri = Uri::uri();
    }

    public function load(){
        if ($this->isHome()){
            return $this->controllerHome();
        }
        
        return $this->controllerNotHome();
    }

    private function isHome(){
        return ($this->uri == '/');
    }

    private function controllerHome(){

    }

    private function controllerNotHome(){
        
    }

}

?>