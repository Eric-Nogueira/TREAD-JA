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
        return (new Database('vaga'))->select($where, $order, $limit)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cadastrar()
    {
        echo 'cadastrar';
    }
}