<?php

namespace App\Model\Entity;
use App\Session\Login;
use PDO;
use \WilliamCosta\DatabaseManager\Database;

class Empresa
{
    
    public $cnpj;
    public $nomefantasia;
    public $razaosocial;
   public $telefone;
    public $email;
    public $endereco;

    public function findByEmail($email){

        $db = new Database('empresa');
        $query = $db->select('email_empresa = "'.$email.'"');

        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function findByCNPJ($cnpj){

        $db = new Database('empresa');
        $query = $db->select('cnpj = "'.$cnpj.'"');

        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function findByRazaoSocial($razao){

        $db = new Database('empresa');
        $query = $db->select('razao_social = "'.$razao.'"');

        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function findByTelefone($tel){

        $db = new Database('empresa');
        $query = $db->select('telefone_empresa = "'.$tel.'"');

        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function checkEmailCnpj($email, $cnpj)
    {
        $db = new Database('empresa');
        $query = $db->select('email_empresa = "' . $email . '"', null, null, 'cnpj');
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result['cnpj'] == $cnpj) {
            return true;
        }
        return false;
    }

    public function cadastrar()
    {
        $db = new Database('empresa');
        $db->insert([
            'cnpj' => $this->cnpj,
            'razao_social' => $this->razaosocial,
            'nome_fantasia' => $this->nomefantasia,
            'telefone_empresa' => $this->telefone,
            'email_empresa' => $this->email,
            'endereco_empresa' => $this->endereco
        ]);

        return true;
    }

    public static function GetNomeByEmail($email)
    {
        $db = new Database('empresa');
        $query = $db->select('email_empresa = "' . $email . '"', null, null, 'nome_fantasia');
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['nome_fantasia'];
    }

}

?>