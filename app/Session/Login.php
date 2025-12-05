<?php

namespace App\Session;

class Login {

    private static function init() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function getUsuarioLogado(){
        self::init();

        return self::isLogged() ? $_SESSION["user"] : null;
    }

    public static function login($email, $password, $type) {
        self::init();

        $_SESSION["user"] = [
            'mail' => $email,
            'cpf' => $password,
            'type' => $type
        ];

        header('location: /');
        exit;
    }

    public static function logout() {
        self::init();
        unset($_SESSION['user']);

        header('location: /login/ja');
        exit;
    }

    public static function isLogged() {
        self::init();
        return isset($_SESSION["user"]['mail']);
    }

    public static function requireLogin() {
        if (!self::isLogged()) {
            header('Location: /login/ja');
            exit;
        }
    } 
    
    public static function requireLogout() {
        if (self::isLogged()) {
            header('Location: /');
            exit;
        }
    }

}