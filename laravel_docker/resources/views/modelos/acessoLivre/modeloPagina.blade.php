<!DOCTYPE html>
<html lang='pt-BR'>
	<head>
        @include('head')

        <!-- Arquivos personalizados de cada página -->
        <title>@yield('tituloPagina')</title>
        @yield('styleAdicional')
    </head>


    <body>
        @include('header')

        @yield('navegacaoAdicional')



        <main>
            @yield('conteudo')
        </main>


        @yield('footerAdicional')

        @include('newsletter')
        @include('footer')
        @yield('scripts')
    </body>
</html>