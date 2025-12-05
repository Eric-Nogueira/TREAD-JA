<?php

namespace App\Model\Entity;
use App\Session\Login;
use PDO;
use \WilliamCosta\DatabaseManager\Database;

class Usuario
{

    public $cpf;
    public $rg;
    public $nome;
    public $telefone;
    public $email;
    public $escolaridade;
    public $endereco;
    public $datanascimento;

    public function findByCPF($cpf)
    {

        $db = new Database('jovem');
        $query = $db->select('cpf = "' . $cpf . '"');

        // Retorna o usuário encontrado (ou null)
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;

    }

    public static function findJaByCPF($cpf)
    {

        $db = new Database('jovem');
        $query = $db->select('cpf = "' . $cpf . '"');

        // Retorna o usuário encontrado (ou null)
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    public function findByRG($rg)
    {

        $db = new Database('jovem');
        $query = $db->select('rg = "' . $rg . '"');

        // Retorna o usuário encontrado (ou null)
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;

    }

    public function findByTelefone($tel)
    {

        $db = new Database('jovem');
        $query = $db->select('telefone = "' . $tel . '"');

        // Retorna o usuário encontrado (ou null)
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;

    }

    public function findByEmail($mail)
    {

        $db = new Database('jovem');
        $query = $db->select('email = "' . $mail . '"');

        // Retorna o usuário encontrado (ou null)
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    public function checkEmailCpf($email, $cpf)
    {
        $db = new Database('jovem');
        $query = $db->select('email = "' . $email . '"', null, null, 'cpf');
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result['cpf'] == $cpf) {
            return true;
        }
        return false;
    }

    public function cadastrar()
    {
        $db = new Database('jovem');
        $db->insert([
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'nome_completo' => $this->nome,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'escolaridade' => $this->escolaridade,
            'endereco' => $this->endereco,
            'data_nascimento' => $this->datanascimento
        ]);

        return true;
    }

    public static function GetNomeByEmail($email)
    {
        $db = new Database('jovem');
        $query = $db->select('cpf = "' . $email . '"', null, null, 'nome_completo');
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['nome_completo'];
    }

    public static function GetCPFByEmail($email)
    {
        $db = new Database('jovem');
        $query = $db->select('email = "' . $email . '"', null, null, 'cpf');
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['cpf'];
    }

    public function updateInfos($cpf, $telefone, $nome, $email, $escolaridade, $endereco){
        $db = new Database('jovem');
        $db->update('cpf = "'. $cpf . '"', [
            'telefone'=> $telefone,
            'nome_completo'=> $nome,
            'email'=> $email,
            'escolaridade'=> $escolaridade,
            'endereco'=> $endereco
        ]);
    }

}

?>