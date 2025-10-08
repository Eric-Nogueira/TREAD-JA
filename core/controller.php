<?php

namespace core;

use app\classes\Uri;

require __DIR__ . '/../app/exceptions/ControllerNotExistException.php';

use app\exceptions\ControllerNotExistException;

class Controller
{

    private $uri;
    private $controller;
    private $namespace;
    private $folders = [
        'app\\controllers\\portal',
        'app\\controllers\\admin'
    ];

    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    public function load()
    {
        if ($this->isHome()) {
            return $this->controllerHome();
        }

        return $this->controllerNotHome();
    }

    private function isHome()
    {
        //var_dump($this->uri);
        if ($this->uri == "/") {
            return $this->uri == "/";
        }
        echo "Isn't Home";
    }

    private function controllerHome()
    {

        var_dump($this->controllerExists('HomeController'));

        if ($this->controllerExists('HomeController')) {
            return $this->InstantiateController();
        }

        throw new ControllerNotExistException("Essa página não existe");
    }

    private function controllerNotHome()
    {
        echo "ERROR 404 \v";
    }

    private function controllerExists($controller)
    {
        $controllerExist = false;

        foreach ($this->folders as $folder) {
            echo 'foreach executando                    ';
            if (class_exists("$folder\\$controller")) {
                $controllerExist = true;
                $this->namespace = $folder;
                $this->controller = $controller;

                var_dump($controllerExist);
            }
        }

        return $controllerExist;
    }

    private function InstantiateController()
    {
        echo "INSTANTIATED\t";
        //$controller = "{$this->namespace}\\{$this->controller}";
        //return new $controller;
    }
}
//O SISTEMA NÃO RECONHECE A CLASSE 'HOMECONTROLLER' E A FUNÇÃO 'CONTROLLEREXISTS()' RETORNA FALSE
//O 'FOREACH' PRESENTE NA FUNÇÃO 'CONTROLLEREXISTS()' EXECUTA QUATRO VEZES, SENDO QUE ELE DEVERIA EXECUTAR SOMENTE DUAS VEZES