<?php

namespace App\Controller\Pages;

use App\Session\Login as LoginSession;
use \App\Utils\View;
use \App\Validation\CPF;
use \App\Model\Entity\Usuario;

class LoginJ extends Page
{
    public static function getLogin()
    {
        LoginSession::requireLogout();

        $content = View::render(
            'pages/login/loginJ',
            []
        );

        return parent::getPage('Login - Jovem Aprendiz', $content);
    }

    public static function handleLogin($request)
    {
        $postVars = $request->getPostVars();

        $usuario = new Usuario();

        // Validação básica
        $email = $postVars['email'] ?? null;
        $cpf = $postVars['cpf'] ?? null;

        if (!$email || !$cpf) {
            // Se falhar validação, retorna à página de login
            return self::getLogin();
        }
        if (!CPF::validateCPF($cpf)) {
            $content = View::render(
                'pages/login/loginJ',
                ['mensagem' => 'CPF inválido. Por favor, verifique e tente novamente.']
            );

            return parent::getPage('Login - Jovem Aprendiz', $content);
        }
        if (!$usuario->findByCPF($cpf)) {
            $content = View::render(
                'pages/login/loginJ',
                ['mensagem' => 'Usuário não encontrado. Verifique o CPF e tente novamente.']
            );

            return parent::getPage('Login - Jovem Aprendiz', $content);
        }
        if (!$usuario->findByEmail($email)) {
            $content = View::render(
                'pages/login/loginJ',
                ['mensagem' => 'Usuário não encontrado. Verifique o E-mail e tente novamente.']
            );
            return parent::getPage('Login - Jovem Aprendiz', $content);
        }else {
            if($usuario->checkEmailCpf($email, $cpf)){
                LoginSession::login($email, $cpf, 'Jovem');
            }
            else{
                $content = View::render('pages/login/loginJ', ['mensagem'=> 'Os valores inseridos não estão correlacionados!']);
            return parent::getPage('Login - Jovem Aprendiz', $content);
            }            
        }
    }
}