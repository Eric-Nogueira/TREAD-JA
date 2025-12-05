<?php

namespace App\Controller\Pages;

use App\Http\Request;
use App\Session\Login;
use \App\Utils\View;
use \App\Model\Entity\Usuario;

class Infos extends Page
{


    public static function getInfo($cpf)
    {
        Login::requireLogin();

        $content = View::render('pages/info', [
            'mensagem' => ''
        ]);


        /*$info = Usuario::FindJaByCPF($cpf);

        print_r($info);

        $content = View::render('pages/info', [
            'jovem.nome' => $info['nome_completo'] ?? 'Sem nome',
            'jovem.rg' => $info['rg'] ?? 'Sem RG',
            'jovem.cpf' => $info['cpf'] ?? 'Pessoa desconhecida',
            'jovem.endereco' => $info['endereco'] ?? 'N/A',
            'jovem.tel' => $info['telefone'] ?? 'N/A',
            'jovem.email' => $info['email'] ?? 'N/A',
            'jovem.escolaridade' => $info['escolaridade'] ?? 'N/A',
            'mensagem' => ''
        ]);*/

        return parent::getPage('Jovem: ' . ('Eric Nogueira Silva' ?? 'Sem nome'), $content);
    }

    public static function handleInfo(Request $request)
    {
        $content = View::render('pages/info', [
            'mensagem' => '<p class="success">Jovem contratado</p>'
        ]);

        return parent::getPage('Jovem: ' . ('Eric Nogueira Silva' ?? 'Sem nome'), $content);    
    }
}

