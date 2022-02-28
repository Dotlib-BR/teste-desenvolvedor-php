<?php
    // Definindo a variável de URL da página
    $urlDaPagina = '/admin/produtos';
    // Palavras-chave
    $palavraChave = 'produtos';
?>



@section('ContagemPesquisa')
    <strong>{{ $contagemPesquisa }}</strong> {{ $palavraChave }}
@endsection



@section('ListaDeDados')
    <div class="lista-de-{{ $palavraChave }} fs-08">
        <!-- Utilidades Globais -->
        <div class="d-flex justify-content-end">
            <a class="mx-1 my-2 btn btn-success" href="#produto-novo" onclick="addInput()">
                <i class="fa-solid fa-plus"></i>
            </a>
           <button class="mx-1 my-2 btn btn-danger" type="button" onclick="deleteAll('{{ $urlDaPagina }}')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Lista de dados -->
        @foreach($dadosLista as $produto)

            <form method="POST">
                <div class="my-4">
                    <div class="text-end">
                        <button id="button-id-{{$produto->produtoId}}" class="my-1 btn btn-sm btn-outline-secondary" type="button" onclick="openInput({{ $produto->produtoId }})">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button id="button-confirm-id-{{$produto->produtoId}}" class="my-1 btn btn-sm btn-outline-success" type="submit" onclick="openInput({{ $produto->produtoId }})" hidden>
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="deleteOne('{{ $urlDaPagina }}', '{{$produto->produtoId}}')">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    
                    <div id="produtos" class="d-flex text-center align-items-center">
                        @csrf
                        <!-- Id -->
                        <div id="#" class="mx-05 col-1">
                            <span>{{$produto->produtoId}}</span>
                            <input type="hidden" name="produtoId" value="{{$produto->produtoId}}">
                        </div>
                        <!-- Nome -->
                        <div id="#" class="mx-05 col-2">
                            <span id="span-nome-{{$produto->produtoId}}">{{$produto->produtoNome}}</span>
                            <input id="input-nome-{{$produto->produtoId}}" class="form-control fs-09 text-center" name="produtoNome" value="{{$produto->produtoNome}}" hidden required>
                        </div>
                        <!-- Autor -->
                        <div class="mx-05 col-2">
                            <span id="span-autor-{{$produto->produtoId}}">{{$produto->produtoAutor}}</span>
                            <input id="input-autor-{{$produto->produtoId}}" class="form-control fs-09" type="text" name="produtoAutor" value="{{$produto->produtoAutor}}" hidden required>
                        </div>
                        <!-- Valor Unitário -->
                        <div class="mx-05 col-1">
                            <span id="span-valor-{{$produto->produtoId}}">{{$produto->produtoValorUnitario}}</span>
                            <input id="input-valor-{{$produto->produtoId}}" class="form-control fs-09" type="text" name="produtoValorUnitario" value="{{$produto->produtoValorUnitario}}" hidden required>
                        </div>
                        <!-- Estoque -->
                        <div class="mx-05 col-1">
                            <span id="span-estoque-{{$produto->produtoId}}">{{$produto->produtoQtdeEstoque}}</span>
                            <input id="input-estoque-{{$produto->produtoId}}" class="form-control fs-09" type="text" name="produtoQtdeEstoque" value="{{$produto->produtoQtdeEstoque}}" hidden required>
                        </div>
                        <!-- Adicionado -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$produto->created_at}}</span>
                        </div>
                        <!-- Última atualização -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$produto->updated_at}}</span>
                        </div>
                    </div>
                </div>
            </form>

        @endforeach

        <!-- Para adicionar novos {{ $palavraChave }} manualmente -->
        <form id="produto-novo" class="my-5" method="POST" style="display: none;" hidden>
            <div class="d-flex text-center align-items-center">
                @csrf
                <!-- Id -->
                <div id="#" class="mx-05 col-1">
                    <!-- -->
                </div>
                <!-- Nome -->
                <div id="#" class="mx-05 col-2">
                    <input id="input-nome-novo" class="form-control fs-08 text-center" name="produtoNome" value="" required>
                </div>
                <!-- Autor -->
                <div class="mx-05 col-2">
                    <input id="input-autor-novo" class="form-control fs-08" type="text" name="produtoAutor" value="" required>
                </div>
                <!-- Valor Unitário -->
                <div class="mx-05 col-1">
                    <input id="input-valor-novo" class="form-control fs-08" type="text" name="produtoValorUnitario" value="" required>
                </div>
                <!-- Estoque -->
                <div class="mx-05 col-1">
                    <input id="input-estoque-novo" class="form-control fs-08" type="text" name="produtoQtdeEstoque" value="" required>
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
        function openInput($produtoId) {
            if (document.getElementById(`input-nome-${$produtoId}`).hasAttribute('hidden')) {

                document.getElementById(`span-nome-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`input-nome-${$produtoId}`).removeAttribute('hidden');
        
                document.getElementById(`span-autor-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`input-autor-${$produtoId}`).removeAttribute('hidden');
                
                document.getElementById(`span-valor-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`input-valor-${$produtoId}`).removeAttribute('hidden');

                document.getElementById(`span-estoque-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`input-estoque-${$produtoId}`).removeAttribute('hidden');
        
                document.getElementById(`button-id-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`button-confirm-id-${$produtoId}`).removeAttribute('hidden');
            } else {
                document.getElementById(`input-nome-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`span-nome-${$produtoId}`).removeAttribute('hidden');
        
                document.getElementById(`input-cpf-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`span-cpf-${$produtoId}`).removeAttribute('hidden');
                
                document.getElementById(`input-email-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`span-email-${$produtoId}`).removeAttribute('hidden');
                
                document.getElementById(`input-autoridade-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`input-span-autoridade-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`span-autoridade-${$produtoId}`).removeAttribute('hidden');
        
                document.getElementById(`button-confirm-id-${$produtoId}`).setAttribute('hidden', '');
                document.getElementById(`button-id-${$produtoId}`).removeAttribute('hidden');
            }
        };

        function addInput() {
            if (document.getElementById('produto-novo').hasAttribute('hidden')) {
                // "hidden" ainda que não mude visualmente, é usado como gatilho
                document.getElementById('produto-novo').removeAttribute('hidden');
                document.getElementById('produto-novo').style = '';
            } else {
                // Leva a página para o topo
                window.scrollTo(0,0);
                // Atribuí "hidden" novamente e esconde o formulário
                document.getElementById('produto-novo').setAttribute('hidden', '');
                document.getElementById('produto-novo').style = 'display: none';
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
