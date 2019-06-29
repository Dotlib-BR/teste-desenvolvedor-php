<?php

if (!function_exists('flashToast')) {
    function flashToast($type, $title) {
        session()->flash('alert', [
            'alert' => 'toast',
            'type'  => $type,
            'title' => $title,
            'text'  => ''
        ]);
    }
}

if (!function_exists('flashModal')) {
    function flashModal($type, $title, $text = '') {
        session()->flash('alert', [
            'alert' => 'swal',
            'type'  => $type,
            'title' => $title,
            'text'  => $text
        ]);
    }
}
