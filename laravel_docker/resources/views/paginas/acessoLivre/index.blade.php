@extends('modelos.acessoLivre.modeloPagina')



@section('navegacaoAdicional')
    <div class="container-fluid background-2">
        <div class="container">

            <!-- As primeiras 5 categorias no DB alfabeticamente -->
            <div class="mx-5 py-1 d-flex justify-content-around fs-11 categorias-em-foco">
                <div class="d-inline">
                    <a id="#" class="" href="/?categoria=Medicina">
                        <span>Medicina</span>
                    </a>
                </div>
                <div class="d-inline">
                    <a id="#" class="" href="/?categoria=Direito">
                        <span>Direito</span>
                    </a>
                </div>
                <div class="d-inline">
                    <a id="#" class="" href="/?categoria=Ficção">
                        <span>Ficção</span>
                    </a>
                </div>
                <div class="d-inline">
                    <a id="#" class="" href="/?categoria=Health">
                        <span>Health</span>
                    </a>
                </div>
                <div class="d-inline">
                    <a id="#" class="" href="/?categoria=Biografia">
                        <span>Biografia</span>
                    </a>
                </div>
                <div class="d-inline">
                    <a id="#" class="" href="/?categoria=Outros">
                        <span>Outros</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection



@section('conteudo')
    <section>
        <div class="container">

            <!-- Referente à categoria de produtos sendo exibida -->
            <div class="mb-3">
                <div class="fs-09" style="width: fit-content;">
                    <span>
                        <strong>Você está em: </strong>
                    </span>
                    <span>{{$categoriaSelecionada}}</span>
                </div>
            </div>


            <!-- Lista de Categorias Completa -->
            <div class="d-flex">
                <div id="lista-categorias-completa" class="col-2">
                    <h4>Categorias</h4>
                    <div>
                        <div class="row">

                            <span class="mx-2 my-2">Categorias de produtos</span>
                            <ul>
                                <?php
                                    foreach($ordenarLista as $ordenar) {
                                        $categoria = $ordenar->categoriaNome;
                                        echo "<li class=\"my-1 text-uppercase fs-09\"><a id=\"#\" class=\"\" href=\"/?categoria=$categoria\"><span>$categoria</span></a></li>";
                                    }
                                ?>
                                
                            </ul>

                        </div>
                    </div>
                </div>


                <div class="col-10">

                    <!-- Banner da loja -->
                    <div class="background-3 container text-center position-relative">
                        <div id="banner-loja">
                            <div></div>
                        </div>
                    </div>

                    <div>
                        <div>
                            <div class="my-2 d-flex align-items-center">

                                <!-- Escolher Categoria de Produtos -->
                                <div class="mx-3 col-3 d-flex controlador-ordenar align-items-center" >
                                    <label class="mx-2">Ordenar</label>
                                    <select id="select-categoria" class="form-select fs-09" name="categoria" onchange="ordenar(document.getElementById('select-categoria'))" onfocus="this.selectedIndex = -1;">
                                        <option value="1">Escolha</option>
                                            <?php
                                                foreach($ordenarLista as $ordenar) {
                                                    $categoria = $ordenar->categoriaNome;
                                                    echo "<option value=\"$categoria\">$categoria</option>";
                                                }
                                            ?>

                                    </select>
                                </div>

                                <!-- Quantidade de produtos a serem exibidos na tela -->
                                <div class="mx-3 col-3 d-flex controlador-exibir align-items-center">
                                    <label class="mx-2">Exibir</label>
                                    <select id="select-exibir" class="form-select fs-08" name="exibir" onchange="ordenar(document.getElementById('select-exibir'))" onfocus="this.selectedIndex = -1;">
                                        <option value="20">20 por página</option>
                                        <option value="40">40 por página</option>
                                        <option value="60">60 por página</option>
                                        <option value="100">100 por página</option>
                                    </select>
                                </div>

                                <!-- Número de produtos encontrados. Formato de exibição dos produtos -->
                                <div class="col">
                                    <div class="d-flex justify-content-end">
                                        <div class="mx-4">
                                            <span class="fs-08">
                                                <strong>{{$contagemPesquisa}}</strong> produtos
                                            </span>
                                        </div>
                                        <div class="d-flex">
                                            <div class="mx-2">
                                                <i class="fa-solid fa-grip fs-18"></i>
                                            </div>
                                            <div class="mx-2">
                                                <i class="fa-solid fa-list fs-16"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- Lista de Produtos -->
                    @include('modelos.acessoLivre.modeloProdutos')
                </div>
            </div>
        </div>
        <form id="inputVariavel">
            <input id="1" type="hidden">
            <input id="2" type="hidden">
        </form>
    </section>
@endsection


@section('scripts')
    <script>
        var inputVariavel1 = document.getElementById('1');
        var inputVariavel2 = document.getElementById('2');

        function ordenar(elemento) {

            let params = new URLSearchParams(location.search);
            if (params.get('categoria') != null) {
                inputVariavel1.setAttribute('name', 'categoria');
                inputVariavel1.setAttribute('value', params.get('categoria'));
            }
            if (params.get('exibir') != null) {
                inputVariavel2.setAttribute('name', 'exibir');
                inputVariavel2.setAttribute('value', params.get('exibir'));
            }

            var name = elemento.getAttribute('name');
            var value = elemento.value;
            if (name == 'categoria') {
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
@endsection

