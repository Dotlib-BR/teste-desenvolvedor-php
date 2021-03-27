<?php

if (!function_exists('decimalParaPagina')) {
    function decimalParaPagina($valor, $prefixo = null)
    {
        if (isset($valor)) {
            return $prefixo . number_format($valor, 2, ',', '.');
        }
    }
}

if (!function_exists('decimalParaBanco')) {
    function decimalParaBanco($valor)
    {
        return str_replace("R$ ", "", str_replace(",", ".", str_replace(".", "", $valor)));
    }
}

function formatoCupomValor($valor)
{
    return number_format($valor, 0);
}

function activeMenu($rota)
{
    if (is_array($rota)) {
        if (count($rota) > 0) {
            foreach ($rota as $rotaSingle) {
                if ((strpos(\Illuminate\Support\Facades\Route::currentRouteName(), $rotaSingle) === 0)) {
                    return ' active ';
                }
            }
        }
    } else {
        return (strpos(\Illuminate\Support\Facades\Route::currentRouteName(), $rota) === 0) ? ' active ' : '';
    }
}

function statusPedidoColor($id)
{
    $status = [
        1 => 'primary',
        2 => 'success',
        3 => 'danger'
    ];

    return (isset($status[$id])) ? $status[$id] : null;
}
