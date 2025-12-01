<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Candidaturas{
     public static function getCandidaturas($cpf)
    {
        // Query que faz JOIN entre as três tabelas:
        // candidata_se -> vaga -> empresa
        // Filtra pelas candidaturas do jovem (por CPF)
        $query = "SELECT 
                    candidata_se.ID_vaga,
                    candidata_se.jovem_cpf,
                    vaga.titulo AS vaga_titulo,
                    vaga.empresa_cnpj,
                    empresa.nome_fantasia AS empresa_nome,
                    empresa.cnpj AS empresa_cnpj_valor
                  FROM candidata_se 
                  INNER JOIN vaga ON candidata_se.ID_vaga = vaga.ID_vaga
                  INNER JOIN empresa ON vaga.empresa_cnpj = empresa.cnpj 
                  WHERE candidata_se.jovem_cpf = '" . $cpf . "'";

        $db = new Database();
        $statement = $db->execute($query);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        
        return $result ? $result : [];
    }

    public static function getEnterpriseCandidaturas($cnpj)
    {
        // Query que faz JOIN entre as três tabelas:
        // candidata_se -> vaga -> empresa
        // Filtra pelas candidaturas do jovem (por CPF)
        $query = "SELECT 
                    candidata_se.ID_vaga,
                    candidata_se.jovem_cpf,
                    vaga.titulo AS vaga_titulo,
                    vaga.empresa_cnpj,
                    jovem.nome_completo as jovem_nome,
                    empresa.*
                  FROM candidata_se 
                  INNER JOIN vaga ON candidata_se.ID_vaga = vaga.ID_vaga
                  INNER JOIN empresa ON vaga.empresa_cnpj = empresa.cnpj 
                  INNER JOIN jovem ON jovem.cpf = candidata_se.jovem_cpf
                  WHERE vaga.empresa_cnpj = '" . $cnpj . "'";

        $db = new Database();
        $statement = $db->execute($query);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        
        return $result ? $result : [];
    }
}