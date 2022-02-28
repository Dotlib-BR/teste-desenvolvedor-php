<?php
    // Definindo a variável de URL da página
    $urlDaPagina = '/admin/categorias';
    // Palavras-chave
    $palavraChave = 'categorias';
?>



@section('ContagemPesquisa')
    <strong>{{ $contagemPesquisa }}</strong> {{ $palavraChave }}
@endsection



@section('ListaDeDados')
    <div class="lista-de-{{ $palavraChave }} fs-09">
        <!-- Utilidades Globais -->
        <div class="d-flex justify-content-end">
            <a class="mx-1 my-2 btn btn-success" href="#categoria-novo" onclick="addInput()">
                <i class="fa-solid fa-plus"></i>
            </a>
           <button class="mx-1 my-2 btn btn-danger" type="button" onclick="deleteAll('{{ $urlDaPagina }}')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Lista de dados -->
        @foreach($dadosLista as $categoria)

            <form method="POST">
                <div class="my-4">
                    <div class="text-end">
                        <button id="button-id-{{$categoria->categoriaId}}" class="my-1 btn btn-sm btn-outline-secondary" type="button" onclick="openInput({{ $categoria->categoriaId }})">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button id="button-confirm-id-{{$categoria->categoriaId}}" class="my-1 btn btn-sm btn-outline-success" type="submit" onclick="openInput({{ $categoria->categoriaId }})" hidden>
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="deleteOne('{{ $urlDaPagina }}', '{{$categoria->categoriaId}}')">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    
                    <div id="categorias" class="d-flex text-center align-items-center">
                        @csrf
                        <!-- Id -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$categoria->categoriaId}}</span>
                            <input type="hidden" name="categoriaId" value="{{$categoria->categoriaId}}">
                        </div>
                        <!-- Nome -->
                        <div id="#" class="mx-05 col-3">
                            <span id="span-nome-{{$categoria->categoriaId}}">{{$categoria->categoriaNome}}</span>
                            <input id="input-nome-{{$categoria->categoriaId}}" class="form-control fs-10 text-center" name="categoriaNome" value="{{$categoria->categoriaNome}}" hidden required>
                        </div>
                        <!-- Adicionado -->
                        <div id="#" class="mx-05 col-3">
                            <span>{{$categoria->created_at}}</span>
                        </div>
                        <!-- Última atualização -->
                        <div id="#" class="mx-05 col-3">
                            <span>{{$categoria->updated_at}}</span>
                        </div>
                    </div>
                </div>
            </form>

        @endforeach

        <!-- Para adicionar novos {{ $palavraChave }} manualmente -->
        <form id="categoria-novo" class="my-5" method="POST" style="display: none;" hidden>
            <div class="d-flex text-center align-items-center">
                @csrf
                <!-- Id -->
                <div id="#" class="mx-05 col-2">
                    <!-- -->
                </div>
                <!-- Nome -->
                <div id="#" class="mx-05 col-3">
                    <input id="input-nome-novo" class="form-control fs-09 text-center" name="categoriaNome" value="" required>
                </div>
                <!-- Adicionado -->
                <div class="mx-05 col-3">
                    <!-- -->
                </div>
                <!-- Última atualização -->
                <div class="mx-05 col-3">
                    <!-- -->
                </div>
            </div>
            <!-- Botão Enviar -->
            <div id="#" class="d-flex text-end">
                <button class="mx-3 my-1 btn btn-outline-success" type="submit">
                    <i class="fa-solid fa-check">  Enviar</i>
                </button>
                <button class="mx-3 my-1 btn btn-outline-primary" type="button" onclick="addInput()">
                    <i class="fa-solid fa-check">  Ignorar</i>
                </button>
            </div>
        </form>

    </div>
@endsection



@section('Scripts')

    <script>
        function openInput($categoriaId) {
            if (document.getElementById(`input-nome-${$categoriaId}`).hasAttribute('hidden')) {

                document.getElementById(`span-nome-${$categoriaId}`).setAttribute('hidden', '');
                document.getElementById(`input-nome-${$categoriaId}`).removeAttribute('hidden');
        
                document.getElementById(`button-id-${$categoriaId}`).setAttribute('hidden', '');
                document.getElementById(`button-confirm-id-${$categoriaId}`).removeAttribute('hidden');
            } else {
                document.getElementById(`input-nome-${$categoriaId}`).setAttribute('hidden', '');
                document.getElementById(`span-nome-${$categoriaId}`).removeAttribute('hidden');
        
                document.getElementById(`button-confirm-id-${$categoriaId}`).setAttribute('hidden', '');
                document.getElementById(`button-id-${$categoriaId}`).removeAttribute('hidden');
            }
        };

        function addInput() {
            if (document.getElementById('categoria-novo').hasAttribute('hidden')) {
                // "hidden" ainda que não mude visualmente, é usado como gatilho
                document.getElementById('categoria-novo').removeAttribute('hidden');
                document.getElementById('categoria-novo').style = '';
            } else {
                // Leva a página para o topo
                window.scrollTo(0,0);
                // Atribuí "hidden" novamente e esconde o formulário
                document.getElementById('categoria-novo').setAttribute('hidden', '');
                document.getElementById('categoria-novo').style = 'display: none';
            }
        };

        function deleteAll($urlDaPagina) {
            if (confirm('Você tem CERTEZA que deseja deletar TUDO?')) {
                location.assign(`${$urlDaPagina}/all`);
            }
        };

        function deleteOne($urlDaPagina, $produtoId) {
            if (confirm('Você tem CERTEZA que deseja deletar?')) {
                location.assign(`${$urlDaPagina}/${$produtoId}`);
            }
        };
    </script>

@endsection
