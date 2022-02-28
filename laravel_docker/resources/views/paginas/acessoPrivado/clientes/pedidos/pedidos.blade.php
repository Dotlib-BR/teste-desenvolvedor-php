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

                <div class="my-4">
                    
                    <div id="pedidos" class="d-flex text-center align-items-center">
                        <!-- PedidoID -->
                        <div id="#" class="mx-05 col-1">
                            <span>{{$pedido->PedidoId}}</span>
                        </div>
                        <!-- CadastroID -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->UsuarioId}}</span>
                        </div>
                        <!-- CarrinhoID -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->CarrinhoId}}</span>
                        </div>
                        <!-- Status -->
                        <div id="#" class="mx-05 col-1">
                            <span id="span-status-{{$pedido->PedidoId}}">
                                <?php
                                    switch ($pedido->Status) {
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
                        </div>
                        <!-- Criação -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->atualizacao}}</span>
                        </div>
                        <!-- Última atualização -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$pedido->criacao}}</span>
                        </div>
                    </div>
                </div>

        @endforeach
    </div>
@endsection