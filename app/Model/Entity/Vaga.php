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

    public function createCandidatura($id, $cpf){
        $db = new Database('candidata_se');
        if(isset($cpf) && isset($id)){

            $select = $db->select('ID_vaga = ' . intval($id), null, null, 'jovem_cpf');
            $result = $select->fetchAll(\PDO::FETCH_ASSOC);

            $exists = false;

            for( $i = 0; $i < count($result); $i++ ){
                if($result[$i]['jovem_cpf'] == $cpf){
                    $exists = true;
                    break;
                }
            }


            if (!$exists) {
                $db->insert([
                    'ID_vaga' => intval($id),
                    'jovem_cpf' => $cpf
                ]);
                return true;
            } else {
                throw new \Exception('Você já se candidatou a essa vaga');
            }
        } else {
            throw new \Exception('Valores não inseridos. Tente novamente');
        }
    }

    public static function insertVaga($titulo, $desc, $jornada, $requisitos ,$cnpj){
        $db = new Database('vaga');
        if(isset($titulo) && isset($desc) && isset($jornada) && isset($requisitos) && isset($cnpj)){
            $db->insert([
                'titulo' => $titulo,
                'descricao'=> $desc,
                'jornada_trabalho'=> $jornada,
                'requisitos'=> $requisitos,
                'empresa_cnpj'=> $cnpj
            ]);
        }
    }

    public static function deleteVaga($id){
        $db = new Database('vaga');
        $dt = new Database('candidata_se');
        $dt->delete('ID_Vaga = '. $id);
        $db->delete('ID_vaga = ' . $id);
    }

    public static function updateVaga($id, $titulo, $desc, $jornada, $requisitos){
        $db = new Database('vaga');

        $db ->update('ID_vaga = ' . $id, [
            'titulo'=> $titulo,
            'descricao'=> $desc,
            'jornada_trabalho' => $jornada,
            'requisitos'=> $requisitos
        ]);
    }
}

