<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Vaga
{
    public $id;
    public $titulo;
    public $descricao;
    public $CNPJempresa;
    public $requisitos;
    public $jornadaDeTrabalho;

    public static function getVagas($where = null, $order = null, $limit = null)
    {
        // Campos que queremos selecionar (ajuste conforme o esquema do seu banco)
        // Seleciona todas as colunas da tabela `vaga` e adiciona o nome da empresa via JOIN.
        // Usamos `vaga.*` para evitar erros caso nomes de colunas no banco sejam diferentes
        // (ex.: `jornada_de_trabalho` vs `jornadaDeTrabalho`).
        $fields = "vaga.*, empresa.nome_fantasia AS empresa_nome";

        // Chama innerJoin diretamente na instância Database (select + join em uma única query)
        $db = new Database('vaga');
        // Ajuste da condição do JOIN para usar os nomes de coluna reais:
        // - coluna na tabela vagas: `empresa_cnpj`
        // - coluna na tabela empresa: `cnpj`
        $statement = $db->innerJoin('empresa', 'vaga.empresa_cnpj = empresa.cnpj', $where, $order, $limit, $fields);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getVagaById($id)
    {
        if (!$id) return null;

        $id = intval($id);
        $query = "SELECT vaga.*, empresa.*
                  FROM vaga 
                  INNER JOIN empresa ON vaga.empresa_cnpj = empresa.cnpj 
                  WHERE vaga.ID_vaga = {$id} 
                  LIMIT 1";

        $db = new Database();
        $statement = $db->execute($query);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        
        return $result ? $result : null;
    }

    public function cadastrar()
    {
        echo 'cadastrar';
    }
}