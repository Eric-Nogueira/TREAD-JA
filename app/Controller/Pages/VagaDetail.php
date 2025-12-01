<?php

namespace App\Controller\Pages;

use App\Session\Login;
use \App\Utils\View;
use \App\Model\Entity\Vaga as VagaModel;

class VagaDetail extends Page
{


    public static function getVagaDetail($id)
    {
        Login::requireLogin();
        if (!$id) {
            throw new \Exception("ID da vaga não fornecido", 400);
        }

        $vaga = VagaModel::getVagaById($id);

        if (!$vaga) {
            throw new \Exception("Vaga não encontrada", 404);
        }

        $content = View::render('pages/vagas/vaga-detail', [
            'vaga.id' => $vaga['ID_vaga'] ?? 'N/A',
            'vaga.titulo' => $vaga['titulo'] ?? 'Sem título',
            'vaga.descricao' => $vaga['descricao'] ?? 'Sem descrição',
            'vaga.empresa' => $vaga['nome_fantasia'] ?? 'Empresa desconhecida',
            'vaga.requisitos' => $vaga['requisitos'] ?? 'N/A',
            'vaga.jornada' => $vaga['jornada_trabalho'] ?? $vaga['jornadaDeTrabalho'] ?? 'N/A',
            'vaga.localizacao' => $vaga['endereco_empresa'] ?? 'N/A',
            'mensagem' => ''
        ]);

        return parent::getPage('Vaga: ' . ($vaga['titulo'] ?? 'Sem título'), $content);
    }

    public static function CreateCandidatura($id){
        
        Login::requireLogin();

        if (!$id) {
            throw new \Exception("ID da vaga não fornecido", 400);
        }

        $vaga = VagaModel::getVagaById($id);

        $obVaga = new VagaModel();

        if($obVaga->createCandidatura($vaga['ID_vaga'], $_SESSION["user"]['cpf'])){
            $content = View::render('pages/vagas/vaga-detail', [
            'vaga.id' => $vaga['ID_vaga'] ?? 'N/A',
            'vaga.titulo' => $vaga['titulo'] ?? 'Sem título',
            'vaga.descricao' => $vaga['descricao'] ?? 'Sem descrição',
            'vaga.empresa' => $vaga['nome_fantasia'] ?? 'Empresa desconhecida',
            'vaga.requisitos' => $vaga['requisitos'] ?? 'N/A',
            'vaga.jornada' => $vaga['jornada_trabalho'] ?? $vaga['jornadaDeTrabalho'] ?? 'N/A',
            'vaga.localizacao' => $vaga['endereco_empresa'] ?? 'N/A',
            'mensagem' => '<p class="success">Candidatado com sucesso!</p>'
        ]);

        return parent::getPage('Vaga: ' . ($vaga['titulo'] ?? 'Sem título'), $content);
        }

        
    }
}
