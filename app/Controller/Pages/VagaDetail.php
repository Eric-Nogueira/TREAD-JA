<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Vaga as VagaModel;

class VagaDetail extends Page
{
    public static function getVagaDetail($id)
    {
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
            'vaga.localizacao' => $vaga['endereco_empresa'] ?? 'N/A'
        ]);

        return parent::getPage('Vaga: ' . ($vaga['titulo'] ?? 'Sem título'), $content);
    }
}
