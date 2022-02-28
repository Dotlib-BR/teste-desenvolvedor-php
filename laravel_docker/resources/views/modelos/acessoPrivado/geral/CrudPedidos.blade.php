<!DOCTYPE html>
<html lang='pt-BR'>
	<head>
		@include('head')

        <!-- Arquivos personalizados de cada página -->
        <title>@yield('tituloPagina')</title>
        <link rel='stylesheet' type='text/css' href='..\css\modelos_acessoPrivado_geral.css'>
        @yield('styleAdicional')
    </head>


    <body>
        @include('header')
        

        <main class="pb-3 pt-1">
            <section class="container">

                <!-- Navegação nos pedidos -->
                <div class="d-flex">
                    <div id="lista-categorias-completa" class="col-2">
                        <h4>Acessar</h4>
                        <div>
                            <div class="row">

                                <span class="mx-2 my-2">Meus pedidos</span>
                                <ul>
                                    @yield('pointerPagina')
                                </ul>

                            </div>
                        </div>
                    </div>


                    <div class="col-10">
                        <div class="mx-3">
                            <div id="#navegacao-carrinho" class="d-flex fs-14 text-center">
                                <div id="#navegacao-carrinho-produto-imagem" class="col">
                                    <span>Imagem</span>
                                </div>
                            
                                <div id="#navegacao-carrinho-produto-nome" class="col">
                                    <a href="{{ $modeloUrl }}?ord=1">
                                        <span>Nome</span>
                                    </a>
                                </div>

                                <div id="#navegacao-carrinho-produto-valor" class="col">
                                    <a href="{{ $modeloUrl }}?ord=2">
                                        <span>Preço</span>
                                    </a>
                                </div>

                                <div id="#navegacao-carrinho-produto-quantidade" class="col">
                                    <a href="{{ $modeloUrl }}?ord=3">
                                        <span>Quantidade</span>
                                    </a>
                                </div>

                                <div id="#navegacao-carrinho-produto-status" class="col">
                                    <a href="{{ $modeloUrl }}?ord=4">
                                        <span>Status</span>
                                    </a>
                                </div>

                                <div id="#navegacao-carrinho-valor-final" class="col">
                                    <a href="#">
                                        <span>Valor Final</span>
                                    </a>
                                </div>
                            </div>

                            <hr>

                            @yield('ListaDePedidos')

                        </div>
                    </div>
                </div>
            </section>
        </main>



        @include('footer')
    </body>
</html>