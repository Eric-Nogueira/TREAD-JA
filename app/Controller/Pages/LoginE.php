<?php

namespace App\Controller\Pages;

use App\Session\Login as LoginSession;
use \App\Utils\View;
use \App\Validation\CNPJ;
use \App\Model\Entity\Empresa;

class LoginE extends Page
{
    public static function getLogin()
    {
        LoginSession::requireLogout();

        $content = View::render(
            'pages/login/loginE',
            [
                'alert' => ''
            ]
        );

        return parent::getPage('Login - Jovem Aprendiz', $content);
    }

    public static function handleLogin($request)
    {
        $postVars = $request->getPostVars();

        $empresa = new Empresa;

        $cnpj = $postVars['cnpj_l'];
        $email = $postVars['email_enterprise_l'];

        if(!CNPJ::validateCNPJ($cnpj)){
            $content = View::render(
            'pages/login/loginE',
            [
                'alert' => 'CNPJ inválido. Tente novamente.'
            ]
        );

        return parent::getPage('Login - Jovem Aprendiz', $content);
        }

        if(!$empresa->findByCNPJ($cnpj)){
            $content = View::render(
            'pages/login/loginE',
            [
                'alert' => 'CNPJ não cadastrado. Tente novamente.'
            ]
        );

        return parent::getPage('Login - Jovem Aprendiz', $content);
        }

        if(!$empresa->findByEmail($email)){
            $content = View::render(
            'pages/login/loginE',
            [
                'alert' => 'Email não cadastrado. Tente novamente.'
            ]
        );

        return parent::getPage('Login - Jovem Aprendiz', $content);
        }

        else {
            if($empresa->checkEmailCnpj($email, $cnpj)){
                LoginSession::login($email, $cnpj, 'Empresa');
            }
            else {
                $content = View::render(
            'pages/login/loginE',
            [
                'alert' => 'Valores não correlacionados. Tente novamente.'
            ]
        );

        return parent::getPage('Login - Jovem Aprendiz', $content);
            }
        }
        
    }
}