    @section('ordenar')
        <option value="2">Nome</option>
        <option value="3">Autor</option>
        <option value="4">Preço</option>
        <option value="5">Estoque</option>
        <option value="6">Formato</option>
    @endsection

    <div class="row">
        @foreach($dadosLista as $produto)         

            <div class="col-3" >
                <!-- Formato do produto -->
                <div id="produto-etiqueta" class="mx-5 my-2 rounded text-center">
                    <small>{{$produto->produtoFormato}}</small>
                </div>

                <!-- Banner produto -->
                <div>    
                    <img src="{{$produto->produtoImagem}}" class="w-100">
                </div>

                <form method="POST">
                    <div class="my-2 d-grid" >
                        <!-- Nome do produto -->
                        <div id="produto-nome" class="m-1">
                            <span class="text-uppercase">{{$produto->produtoNome}}</span>
                        </div>
                        <!-- Autor do produto -->
                        <div id="produto-autor">
                            <small class="p-1 fs-07">{{$produto->produtoAutor}}</small>
                        </div>

                        <div id="produto-preco" class="my-2 fs-14 text-center">
                            <!-- Preço do produto -->
                            <span>R$ {{$produto->produtoValorUnitario}}</span>
                        </div>

                        <!-- Informações para adicionar esse produto ao carrinho -->
                            @csrf
                            <input type="hidden" name="produto_id" value="{{ $produto->produtoId }}">
                        
                        
                        <button id="comprar-produto" class="btn btn-outline-warning" type="submit">Comprar</button>
                    </div>
                </form>
                
            </div>

        @endforeach
    </div>