<?php

namespace App\Controller\Pages;

use App\Session\Login;
use \App\Utils\View;
use \App\Model\Entity\Vaga as VagaModel;

class EditarVaga extends Page
{
    public static function GetEditVaga($id)
    {
        Login::requireLogin();

        if ($_SESSION["user"]['type'] == 'Jovem') {
            header('location: /');
        }

        if ($_SESSION["user"]['type'] == 'Empresa') {
            $content = View::render(
                'pages/vagas/newvaga',
                [
                    'return' => ''
                ]
            );
        }

        return parent::getPage('Nova vaga', $content);
    }

    public static function EditVaga($id)
    {
        Login::requireLogin();
        $vaga = new VagaModel();

        if (isset($id)) {
            $vaga::updateVaga($id, $_POST['titulo'], $_POST['desc'], $_POST['jornada'], $_POST['requisitos']);
        }

        $vag = VagaModel::getVagaById($id);

        if (!$vag) {
            throw new \Exception("Vaga não encontrada", 404);
        }

        $content = View::render('pages/vagas/vaga-detailE', [
            'vaga.id' => $vag['ID_vaga'] ?? 'N/A',
            'vaga.titulo' => $vag['titulo'] ?? 'Sem título',
            'vaga.descricao' => $vag['descricao'] ?? 'Sem descrição',
            'vaga.empresa' => $vag['nome_fantasia'] ?? 'Empresa desconhecida',
            'vaga.requisitos' => $vag['requisitos'] ?? 'N/A',
            'vaga.jornada' => $vag['jornada_trabalho'] ?? $vag['jornadaDeTrabalho'] ?? 'N/A',
            'vaga.localizacao' => $vag['endereco_empresa'] ?? 'N/A',
            'mensagem' => ''
        ]);
    
        return parent::getPage('Vaga: ' . ($vag['titulo'] ?? 'Sem título'), $content);

    }
}