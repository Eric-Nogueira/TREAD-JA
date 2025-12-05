<?php

namespace App\Controller\Pages;

use App\Session\Login as LoginSession;
use \App\Utils\View;
use \App\Validation\CPF;
use \App\Model\Entity\Usuario;


class CadastrarJ extends Page
{
    public static function getCadastrar()
    {
        LoginSession::requireLogout();

        $content = View::render(
            'pages/cadastrar/cadastrarJ',
            [
                'alert.cpf' => '',
                'alert.rg' => '',
                'alert.phone' => '',
                'alert.mail' => ''
            ]
        );

        return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
    }

    public static function handleCadastrar($request)
    {
        $postVars = $request->getPostVars();

        // Validação básica
        $email = $postVars['email'] ?? null;
        $cpf = $postVars['cpf'] ?? null;
        $nome = $postVars['name'] ?? null;
        $rg = $postVars['rg'] ?? null;
        // aceitar tanto os nomes em inglês quanto em português caso o form use outro padrão
        $datanascimento = $postVars['birthdate'] ?? $postVars['data_nascimento'] ?? null;
        $endereco = $postVars['address'] ?? $postVars['endereco'] ?? null;
        $telefone = $postVars['phone'] ?? $postVars['telefone'] ?? null;
        $escolaridade = $postVars['education'] ?? $postVars['escolaridade'] ?? null;


        // Verifica campos obrigatórios
        if (empty($nome) || empty($cpf) || empty($telefone) || empty($email)) {
            $content = View::render('pages/cadastrar/cadastrarJ', [
                'alert.cpf' => 'Preencha todos os campos obrigatórios (nome, CPF, telefone, e-mail).',
                'alert.rg' => 'Preencha todos os campos obrigatórios (nome, CPF, telefone, e-mail).',
                'alert.phone' => 'Preencha todos os campos obrigatórios (nome, CPF, telefone, e-mail).',
                'alert.mail' => 'Preencha todos os campos obrigatórios (nome, CPF, telefone, e-mail).'
            ]);

            return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
        }

        if (CPF::validateCPF($cpf)) {
            $usuario = new Usuario();

            if ($usuario->findByCPF($cpf)) {
                // CPF já cadastrado
                $content = View::render('pages/cadastrar/cadastrarJ', [
                    'alert.cpf' => 'CPF já cadastrado. Por favor, utilize outro CPF.',
                    'alert.rg' => '',
                    'alert.phone' => '',
                    'alert.mail' => ''
                ]);

                return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
            }
             if ($usuario->findByEmail($email)) {
                // CPF já cadastrado
                $content = View::render('pages/cadastrar/cadastrarJ', [
                    'alert.cpf' => '',
                    'alert.rg' => '',
                    'alert.phone' => '',
                    'alert.mail' => 'E-mail já cadastrado. Tente novamente.'
                ]);

                return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
            } if ($usuario->findByTelefone($telefone)) {
                // CPF já cadastrado
                $content = View::render('pages/cadastrar/cadastrarJ', [
                    'alert.cpf' => '',
                    'alert.rg' => '',
                    'alert.phone' => 'Telefone já cadastrado. Tente novamente.',
                    'alert.mail' => ''
                ]);

                return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
            }
             if ($usuario->findByRG($rg)) {
                // CPF já cadastrado
                $content = View::render('pages/cadastrar/cadastrarJ', [
                    'alert.cpf' => '',
                    'alert.rg' => 'RG já cadastrado. Tente novamente.',
                    'alert.phone' => '',
                    'alert.mail' => ''
                ]);

                return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
            }

            $usuario->cpf = $cpf;
            $usuario->rg = $rg;
            $usuario->nome = $nome;
            $usuario->endereco = $endereco;
            $usuario->telefone = $telefone;
            $usuario->datanascimento = $datanascimento;
            $usuario->escolaridade = $escolaridade;
            $usuario->email = $email;
            $usuario->cadastrar();

            $content = View::render('pages/cadastrar/cadastrarJ', [
                'mensagem' => 'Cadastro realizado com sucesso.'
            ]);

            return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
        } else {
            // CPF inválido
            $content = View::render('pages/cadastrar/cadastrarJ', [
                'mensagem' => 'CPF inválido. Por favor, verifique e tente novamente.'
            ]);

            return parent::getPage('Cadastrar - Jovem Aprendiz', $content);
        }
    }
}