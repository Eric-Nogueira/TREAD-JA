<?php

namespace App\Validation;

class CPF
{

    public static function validateCPF($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        $cpfValidacao = substr($cpf, 0, 9);
        $cpfValidacao .= self::calcularDigitoVerificador($cpfValidacao);
        $cpfValidacao .= self::calcularDigitoVerificador($cpfValidacao);

        return $cpf == $cpfValidacao;
    }
    public static function calcularDigitoVerificador($base)
    {
        $tamanho = strlen($base);
        $multiplicador = $tamanho + 1;
        $soma = 0;

        for ($i = 0; $i < $tamanho; $i++) {
            $soma += intval($base[$i]) * $multiplicador;
            $multiplicador--;
        }

        $resto = $soma % 11;
        return ($resto < 2) ? 0 : 11 - $resto;
    }
}