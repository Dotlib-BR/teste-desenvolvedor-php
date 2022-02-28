<?php
    // Definindo a variável de URL da página
    $urlDaPagina = '/admin/cadastros';
    // Palavras-chave
    $palavraChave = 'cadastros';
?>



@section('ContagemPesquisa')
    <strong>{{ $contagemPesquisa }}</strong> {{ $palavraChave }}
@endsection



@section('ListaDeDados')
    <div class="lista-de-{{ $palavraChave }} fs-08">
        <!-- Utilidades Globais -->
        <div class="d-flex justify-content-end">
           <button class="mx-1 my-2 btn btn-danger" type="button" onclick="deleteAll('{{ $urlDaPagina }}')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Lista de dados -->
        @foreach($dadosLista as $pedido)

            <form method="POST">
                <div class="my-4">
                    <div class="text-end">
                        <button id="button-id-{{$pedido->pedidoId}}" class="my-1 btn btn-sm btn-outline-secondary" type="button" onclick="openInput('{{ $pedido->pedidoId }}')">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button id="button-confirm-id-{{$pedido->pedidoId}}" class="my-1 btn btn-sm btn-outline-success" type="submit" onclick="openInput('{{ $pedido->pedidoId }}')" hidden>
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="deleteOne('{{ $urlDaPagina }}', '{{ $pedido->pedidoId }}')">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    
                    <div id="pedidos" class="d-flex text-center align-items-center">
                        @csrf
                        <!-- PedidoID -->
                        <div id="#" class="mx-05 col-1">
                            <span>{{$pedido->pedidoId}}</span>
                            <input type="hidden" name="pedidoId" value="{{$pedido->pedidoId}}">
                        </div>
                        <!-- CadastroID -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->pedidoCadastroId}}</span>
                        </div>
                        <!-- CarrinhoID -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->pedidoCarrinhoId}}</span>
                        </div>
                        <!-- Status -->
                        <div id="#" class="mx-05 col-1">
                            <span id="span-status-{{$pedido->pedidoId}}">
                                <?php
                                    switch ($pedido->pedidoStatus) {
                                        case 0:
                                            echo 'Cancelado';
                                            break;
                                        case 1:
                                            echo 'Aberto';
                                            break;
                                        case 2:
                                            echo 'Cancelado';
                                            break;
                                    }
                                ?>
                            </span>
                            <select id="input-status-{{$pedido->pedidoId}}" class="form-select fs-09 text-center" name="pedidoStatus" hidden>
                                <option value="1">Aberto</option>
                                <option value="2">Pago</option>
                                <option value="0">Cancelado</option>
                            </select>
                        </div>
                        <!-- Cod Barras -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->pedidoCodBarras}}</span>
                        </div>
                        <!-- Criação -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->created_at}}</span>
                        </div>
                        <!-- Última atualização -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->updated_at}}</span>
                        </div>
                    </div>
                </div>
            </form>

        @endforeach
    </div>
@endsection



@section('Scripts')

    <script>
        function openInput($pedidoId) {
            if (document.getElementById(`input-status-${$pedidoId}`).hasAttribute('hidden')) {

                document.getElementById(`span-status-${$pedidoId}`).setAttribute('hidden', '');
                document.getElementById(`input-status-${$pedidoId}`).removeAttribute('hidden');

                // Para mostrar o botão de submit
                document.getElementById(`button-id-${$pedidoId}`).setAttribute('hidden', '');
                document.getElementById(`button-confirm-id-${$pedidoId}`).removeAttribute('hidden');
            } else {
                document.getElementById(`input-status-${$pedidoId}`).setAttribute('hidden', '');
                document.getElementById(`span-status-${$pedidoId}`).removeAttribute('hidden');

                // Para esconder o botão de submit
                document.getElementById(`button-confirm-id-${$pedidoId}`).setAttribute('hidden', '');
                document.getElementById(`button-id-${$pedidoId}`).removeAttribute('hidden');
            }
        };

        function deleteAll($urlDaPagina) {
            if (confirm('Você tem CERTEZA que deseja deletar TUDO?')) {
                location.assign(`${$urlDaPagina}/all`);
            }
        };

        function deleteOne($urlDaPagina, $pedidoId) {
            if (confirm('Você tem CERTEZA que deseja deletar?')) {
                location.assign(`${$urlDaPagina}/${$pedidoId}`);
            }
        };
    </script>

@endsection
