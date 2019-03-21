<?php

if (! function_exists('array_remove_keys')) {
    function array_remove_keys(array $array, array $keys)
    {
        $result = [];

        foreach ($array as $item) {
            $diff = array_diff_key($item, array_flip($keys));
            array_push($result, $diff);
        }   

        return $result;
    }
}