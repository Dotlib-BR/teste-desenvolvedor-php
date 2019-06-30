<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('style')
    </head>
    <body>
        @auth
            @include('includes.header')
        @endauth

        <main class="{{ (!auth()->check()) ? 'h-100' : '' }}">
            @yield('content')
        </main>

        @auth
            @include('includes.footer')
        @endauth

        @include('components.alert')

        <script src="{{ asset('js/app.js') }}"></script>
        @stack('script')
    </body>
</html>