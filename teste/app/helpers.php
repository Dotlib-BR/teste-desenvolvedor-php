<?php

if (! function_exists('consumeZeus')) {// Para evitar conflitos.
    function consumeZeus($url, $method = 'GET', $data = []) {
        $curl = curl_init($url);
        $data = json_encode($data);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Content-Length: '.strlen($data),
            'Authorization: Zeus '.auth()->user()->api_token
        ]);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);

        if (! empty($data)) {//Métodos update e store precisam dessa opção.
            curl_setopt($curl,CURLOPT_POST, ($method === 'POST' ? true : false));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }
}

if (! function_exists('removePage')) {// Remove o parâmetro page para evitar problemas de paginação.
    function removePage($params) {
        array_pop($params);//deve remover o parâmetro page apenas.

        return http_build_query($params);
    }
}

if (! function_exists('setActive')) {// Adiciona a classe 'active' no 'li' da página atual com regex.
    function setActive($path, $active = 'active') {
        return call_user_func_array(
            'Request::is',
            (array) $path
        ) ? $active : '';
    }
}

if (! function_exists('maskCpf')) {// Máscara para CPF
    function maskCpf($cpf) {
        if (strlen($cpf) === 11) {
            return  vsprintf('%d%d%d.%d%d%d.%d%d%d-%d%d', str_split($cpf));// Se vier em letras ele vai transaforma em digitos.
        } else {
            return '-';
        }
    }
}


if (! function_exists('totalWithDiscount')) {// Calcula o total da compra com desconto.
    function totalWithDiscount($total, $discount = null) {
        if ($discount != null) {
            $result = ($discount / 100) * $total;
            $result = $total - $result;

            return '$'.number_format($result, 2, ',', '.');
            // Não vai dar o valor exato, o number format arredonda
            // Poderia usar 'composer require cknow/laravel-money' se quisesse mais precisão mas decidi fazer na mão.
        }

        return '$'.number_format($total, 2, ',', '.');
    }
}
