<?php
/**
 * Created by PhpStorm.
 * User: Vlademir Junior
 * Date: 02/07/2019
 * Time: 03:31
 */
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow" />
<meta name="description" content="Teste Dot.lib">
<meta name="author" content="Vlademir Manoel Dos Santos Junior">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Dot.Lib') }} - @yield('title')</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.ico')  }}">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Javascripts -->
<script src="{{ asset('js/app.js') }}"></script>
