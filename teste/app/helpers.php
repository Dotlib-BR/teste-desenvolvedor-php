<?php
/**
 * Created by PhpStorm.
 * User: Vlademir Junior
 * Date: 03/07/2019
 * Time: 23:08
 */

if (! function_exists('getZeus')) {// para evitar conflitos
    function getZeus($url, $method = 'GET') {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Zeus '.auth()->user()->api_token
        ]);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }
}
