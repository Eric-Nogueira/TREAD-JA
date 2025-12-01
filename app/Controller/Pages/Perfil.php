<?php

namespace App\Controller\Pages;

use App\Model\Entity\Empresa;
use App\Model\Entity\Vaga as VagaModel;
use App\Session\Login;
use \App\Utils\View;
use \App\Model\Entity\Usuario;
use \App\Model\Entity\Candidaturas;

class Perfil extends Page
{
    public static function getPerfil()
    {
        Login::requireLogin();

        if ($_SESSION["user"]['type'] == 'Jovem') {
            $user = new Usuario();
            $nome = $user->GetNomeByEmail($_SESSION["user"]['mail']);
            $id = $_SESSION['user']['cpf'];

            $content = View::render(
                'pages/perfil',
                [
                    'name' => $nome,
                    'id' => $id,
                    'itensCandidatura' => self::getCandidaturasItens()
                ]
            );
        }
        if ($_SESSION["user"]['type'] == 'Empresa') {
            $empresa = new Empresa();
            $nome = $empresa->GetNomeByEmail($_SESSION["user"]['mail']);
            $id = $_SESSION['user']['cpf'];

            $content = View::render(
                'pages/perfilE',
                [
                    'name' => $nome,
                    'id' => $id,
                    'itensCandidatura' => self::getSelfCandidaturas(),
                    'itensVagas' => self::getSelfVagas()
                ]
            );
        }

        return parent::getPage('Tread JA - Perfil', $content);
    }

    private static function getCandidaturasItens()
    {

        $itens = '';

        $candidaturas = Candidaturas::getCandidaturas($_SESSION['user']['cpf']);

        if (is_array($candidaturas)) {
            foreach ($candidaturas as $objCand) {
                $itens .= View::render('pages/candidaturas/itemCandidatura', [
                    'vaga.id' => $objCand['ID_vaga'] ?: 'XXXX',
                    'vaga.titulo' => $objCand['vaga_titulo'] ?: 'Vazio',
                    'vaga.empresa' => $objCand['empresa_nome'] ?: 'Vazio'
                ]);
            }
        }

        return $itens;
    }

    private static function getSelfCandidaturas()
    {

        $itens = '';

        $candidaturas = Candidaturas::getEnterpriseCandidaturas($_SESSION['user']['cpf']);

        if (is_array($candidaturas)) {
            foreach ($candidaturas as $objCand) {
                $itens .= View::render('pages/candidaturas/itemCandidatura', [
                    'vaga.id' => $objCand['ID_vaga'] ?: 'XXXX',
                    'vaga.titulo' => $objCand['vaga_titulo'] ?: 'Vazio',
                    'vaga.empresa' => $objCand['jovem_nome'] ?: 'Vazio'
                ]);
            }
        }

        return $itens;
    }

    public static function getSelfVagas()
    {
        $itens = '';

        $vagas = VagaModel::getVagas('empresa_cnpj = "' . $_SESSION["user"]['cpf'] . '"', 'ID_vaga DESC');

        if (is_array($vagas)) {
            foreach ($vagas as $objVaga) {
                $itens .= View::render('pages/vagas/item', [
                    'vaga.id' => $objVaga['ID_vaga'] ?: 'XXXX',
                    'vaga.titulo' => $objVaga['titulo'] ?: 'Vazio',
                    'vaga.empresa' => $objVaga['empresa_nome'] ?: 'Vazio'
                ]);
            }
        }

        return $itens;
    }
}

?>