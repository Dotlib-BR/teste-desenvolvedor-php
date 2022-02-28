@extends('modelos.acessoLivre.modeloPagina')



@section('tituloPagina')
    Meus Pedidos
@endsection


@section('styleAdicional')
    <link rel='stylesheet' type='text/css' href='..\css\modelos_acessoPrivado_geral.css'>
@endsection


@section('conteudo')

    <?php $listaFinalizar = []; $valorFinal = 0;?>
    
    <section class="container">
        <div class="my-3 d-grid">
            <span class="fs-16">
                Carrinho de compras
            </span>
            <small>
                <a class="mx-2" href="/carrinho/excluir/all">
                    Deletar carrinho
                </a>
            </small>
        </div>

        <hr>

        <div>
            <form class="d-flex" method="POST">
                @csrf
                <div class="col-10 row">
    
        
                        @foreach($dadosLista as $pedidos)
        
                            <?php
                                // Para ter controle dos itens do carrinho
                                $listaFinalizar['dadosInput'][intval($pedidos->ProdutoId)] = intval($pedidos->Quantidade);
        
                                // Para Calcular o Valor Final
                                $valorFinal += intval($pedidos->ValorUnitario) * intval($pedidos->Quantidade);
                            ?>
        
                            <div class="m-2 col-5 row">
                                <div class="row">
                                    <!-- banner do produto -->
                                    <div class="col">
                                        <img class="w-100" alt="produto imagem" src="{{ $pedidos->ImagemPath }}">
                                    </div>
        
                                    <!-- informações do produto -->
                                    <div class="col">
        
                                        
                                        <div class="mb-3 d-grid">
                                            <span class="fs-11 text-uppercase fw-bold">
                                                {{$pedidos->Nome}}
                                            </span><small class="px-2 fs-07">
                                                {{$pedidos->Autor}}
                                            </small>
                                            
                                            
                                        </div>
        
                                        <div class="d-grid w-75">
                                            <span class="mx-2 my-1 form-control">
                                                Qtd: {{$pedidos->Quantidade}}
                                            </span>
                                            <span class="mx-2 my-2 w-75 btn btn-sm btn-danger fs-07">
                                                <a href="/carrinho/excluir/{{ $pedidos->ProdutoId }}">
                                                    Excluir
                                                </a>
                                            </span>
                                        </div>
                                    </div>
        
                                    
                                </div>
                                
                            </div>
        
                        @endforeach
        
    
                </div>
    
                <div id="carrinho-divisor" class="col-2">
                        
                        <div class="my-3">
                            <span class="fs-14">Finalize sua compra :)</span>
                        </div>
        
                        <div>
        
                            <!-- Valor Final do Pedido -->
                            <div class="mx-2 my-2">
                                <span>
                                    Valor final de 
                                </span><br>
                                
                                <span class="mx-3 text-success fs-12 fw-bold">
                                    - R$ <?php $listaFinalizar['valorFinal'] = $valorFinal; echo $valorFinal;?> -
                                </span>
                            </div>
                            
                        </div>
        
                        <hr>
        
                        <button class="btn btn-success" type="submit">
                            Finalizar compra
                        </button>
                        
                        <!-- Por favor, ignore. Informações sobre o fechamento do carrinho -->
                        <textarea name="informacoesCarrinho" id="informacoes" cols="0" rows="0" hidden><?php echo json_encode($listaFinalizar, JSON_PRETTY_PRINT); ?></textarea>
                        <!--  -->
        
                </div>
            </form>
        </div>
    </section>
            
@endsection