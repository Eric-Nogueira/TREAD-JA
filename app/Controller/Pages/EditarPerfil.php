<?php

namespace App\Controller\Pages;

use App\Http\Request;
use App\Session\Login as LoginSession;
use \App\Utils\View;
use \App\Model\Entity\Empresa;
use \App\Model\Entity\Usuario;


class EditarPerfil extends Page
{
    public static function getEdit()
    {
        LoginSession::requireLogin();

        if ($_SESSION["user"]['type'] == 'Jovem') {
            $content = View::render(
                'pages/editarperfil'
            );

            return parent::getPage('Editar perfil - Jovem Aprendiz', $content);
        }

        if($_SESSION['user']['type'] == 'Empresa') {
            $content = View::render(
                'pages/editarperfilE'
            );

            return parent::getPage('Editar perfil - Empresa', $content);
        }
    }

    public static function handleEdit(Request $request)
    {
        LoginSession::requireLogin();

        if ($_SESSION['user']['type'] == 'Empresa') {
            $emp = new Empresa();
            $emp->updateInfos($_SESSION["user"]['cpf'], $_POST['nome'], $_POST['tel'], $_POST['mail'], $_POST['endereco']);
            header('location: /');
        }
        if($_SESSION['user']['type'] == 'Jovem') {
            $user = new Usuario();
            $user->updateInfos($_SESSION["user"]['cpf'], $_POST['tel'], $_POST['nome'], $_POST['mail'], $_POST['escolaridade'], $_POST['endereco']);
            header('location: /');
        }

        
    }
}