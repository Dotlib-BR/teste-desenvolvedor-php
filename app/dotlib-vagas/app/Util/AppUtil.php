<?php


namespace App\Util;


class AppUtil
{
    public static function limpaValor($valor){
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return $valor;
    }
}
