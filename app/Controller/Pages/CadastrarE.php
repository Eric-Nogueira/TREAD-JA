<?php

namespace App\Controller\Pages;

use App\Session\Login as LoginSession;
use \App\Utils\View;
use \App\Validation\CNPJ;
use \App\Model\Entity\Empresa;


class CadastrarE extends Page
{
    public static function getCadastrar()
    {
        LoginSession::requireLogout();

        $content = View::render(
            'pages/cadastrar/cadastrarE',
            [
                'alert.cnpj' => '',
                'alert.razao' => '',
                'alert.phone' => '',
                'alert.mail' => ''
            ]
        );

        return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
    }

    public static function handleCadastrar($request)
    {
        $postVars = $request->getPostVars();

        $nomefantasia = $postVars['nf'];
        $razaosocial = $postVars['social_reason'];
        $cnpj = $postVars['cnpj'];
        $endereco = $postVars['address_enterprise'];
        $telefone = $postVars['phone_enterprise'];
        $email = $postVars['email_enterprise'];

        if (CNPJ::validateCNPJ($cnpj)) {
            $empresa = new Empresa();

            if ($empresa->findByCnpj($cnpj)) {
                $content = View::render(
                    'pages/cadastrar/cadastrarE',
                    [
                        'alert.cnpj' => 'CNPJ já cadastrado. Tente novamente.',
                        'alert.razao' => '',
                        'alert.phone' => '',
                        'alert.mail' => ''
                    ]
                );

                return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
            }

            if ($empresa->findByEmail($email)) {
                $content = View::render(
                    'pages/cadastrar/cadastrarE',
                    [
                        'alert.cnpj' => '',
                        'alert.razao' => '',
                        'alert.phone' => '',
                        'alert.mail' => 'E-mail já cadastrado. Tente novamente.'
                    ]
                );

                return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
            }
            
            if ($empresa->findByRazaoSocial($razaosocial)) {
                $content = View::render(
                    'pages/cadastrar/cadastrarE',
                    [
                        'alert.cnpj' => '',
                        'alert.razao' => 'Razão social já cadastrada. Tente novamente.',
                        'alert.phone' => '',
                        'alert.mail' => ''
                    ]
                );

                return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
            }
            
            if ($empresa->findByTelefone($telefone)) {
                $content = View::render(
                    'pages/cadastrar/cadastrarE',
                    [
                        'alert.cnpj' => '',
                        'alert.razao' => '',
                        'alert.phone' => 'Telefone já cadastrado. Tente novamente.',
                        'alert.mail' => ''
                    ]
                );

                return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
            }

            $empresa->cnpj = $cnpj;
            $empresa->telefone = $telefone;
            $empresa->razaosocial = $razaosocial;
            $empresa->email = $email;
            $empresa->endereco = $endereco;
            $empresa->nomefantasia = $nomefantasia;
            $empresa->cadastrar();

        } else {
            $content = View::render(
                'pages/cadastrar/cadastrarE',
                [
                    'alert.cnpj' => 'CNPJ inválido. Tente novamente.',
                    'alert.razao' => '',
                    'alert.phone' => '',
                    'alert.mail' => ''
                ]
            );

            return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
        }

    }
}