<!DOCTYPE html>
<html lang='pt-BR'>
	<head>
		@include('head')

        <!-- Arquivos personalizados de cada página -->
        <title>@yield('tituloPagina')</title>
        @yield('styleAdicional')
    </head>


    <body>
        <div class="mt-2 mb-3 text-start">
            <a href="/" class="mx-3">
                <img class="h-25" src="https://dotlib.com/theme/img/logos/logo.png" alt="logo">
            </a>    
        </div>
        

        <main class="pb-3 pt-1">
            <section class="mx-2">

                <!-- Navegação nos pedidos -->
                <div class="d-flex">
                    <div id="lista-categorias-completa" class="col-2">
                        <h4>Acessar</h4>
                        <div>
                            <div class="row">

                                <span class="mx-2 my-2">Página do Sistema</span>
                                <ul>
                                    @yield('pointerPagina')
                                </ul>

                            </div>
                        </div>
                    </div>


                    <div id="tabela-admin" class="col-10">
                        <div class="mx-3">
                            @yield('Cabecario')
                            
                            <hr>

                            <div class="d-flex justify-content-between">
                                <select id="select-exibir" class="form-select w-25 fs-08" name="exibir" onchange="ordenar(document.getElementById('select-exibir'))" onfocus="this.selectedIndex = -1;">
                                    <option value="20">20 por página</option>
                                    <option value="40">40 por página</option>
                                    <option value="60">60 por página</option>
                                    <option value="100">100 por página</option>
                                </select>
                                
                                <small class="fs-08">
                                    @yield('ContagemPesquisa')
                                </small>
                            </div>

                            <!-- Tabela -->

                            @yield('ListaDeDados')

                        </div>
                    </div>
                </div>
                <form id="inputVariavel">
                    <input id="1" type="hidden">
                    <input id="2" type="hidden">
                </form>
            </section>
        </main>

        <script>
            var inputVariavel1 = document.getElementById('1');
            var inputVariavel2 = document.getElementById('2');

            function ordenar(elemento) {

                let params = new URLSearchParams(location.search);
                if (params.get('ord') != null) {
                    inputVariavel1.setAttribute('name', 'ord');
                    inputVariavel1.setAttribute('value', params.get('ord'));
                }
                if (params.get('exibir') != null) {
                    inputVariavel2.setAttribute('name', 'exibir');
                    inputVariavel2.setAttribute('value', params.get('exibir'));
                }

                var name = elemento.getAttribute('name');
                var value = elemento.value;
                if (name == 'ord') {
                    inputVariavel1.setAttribute('name', name);
                    inputVariavel1.setAttribute('value', value);
                    inputVariavel1.parentElement.submit();
                } else {
                    inputVariavel2.setAttribute('name', name);
                    inputVariavel2.setAttribute('value', value);
                    inputVariavel2.parentElement.submit();
                }
            }
        </script>
        @yield('Scripts')

    </body>
</html>