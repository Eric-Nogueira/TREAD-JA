<?php

namespace App\Validation;

class CNPJ
{

    public static function validateCNPJ($cnpj)
    {
        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpj) != 14) {
            return false;
        }

        $cnpjValidacao = substr($cnpj, 0, 12);
        $cnpjValidacao .= self::calcularDigitoVerificador($cnpjValidacao);
        $cnpjValidacao .= self::calcularDigitoVerificador($cnpjValidacao);

        return $cnpj == $cnpjValidacao;
    }
    public static function calcularDigitoVerificador($base)
    {
        $tamanho = strlen($base);
        $multiplicador = 9;
        $soma = 0;

        for ($i = ($tamanho-1); $i >= 0; $i--) {
            $soma += intval($base[$i]) * $multiplicador;
            $multiplicador = ($multiplicador == 2) ? 9 : $multiplicador - 1;
        }

        return $soma%11;
    }
}