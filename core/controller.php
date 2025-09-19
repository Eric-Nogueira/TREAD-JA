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
        'app/controllers/portal',
        'app/controllers/admin'
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
        return ($this->uri == '/');
    }

    private function controllerHome()
    {
        if (!$this->controllerExists('HomeController')) {
            throw new ControllerNotExistException("Essa página não existe");
        }
        return $this->InstantiateController();
    }

    private function controllerNotHome()
    {

    }

    private function controllerExists($controller)
    {
        $controllerExist = false;

        foreach ($this->folders as $folder) {
            if (class_exists("{$folder}\\{$controller}")) {
                $controllerExist = true;
                $this->namespace = $folder;
                $this->controller = $controller;
            }
        }

        return $controllerExist;
    }

    private function InstantiateController()
    {
        $controller = "{$this->namespace}\\{$this->controller}";
        return new $controller;
    }

}

//NÃO ESTÁ CARREGANDO A HomeController
