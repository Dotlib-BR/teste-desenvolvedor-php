<?php

if (! function_exists('consumeZeus')) {// Para evitar conflitos.
    function consumeZeus($url, $method = 'GET', $data = []) {

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Zeus '.auth()->user()->api_token
        ]);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
        if (! empty($data)) {//Métodos update e store precisam dessa opção.
            curl_setopt($curl,CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
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
