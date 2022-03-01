@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/api/cadastrarPedido">Cadastrar Novo Pedido de Compras</a>

                <div class="table-responsive" style="margin-top:1rem;">
                    <table class="table table-bordered" id="tabelaEditar" >
                      <thead  class="table-dark">
                        <tr>
                          <th >Cliente</th>
                          <th >Número do Pedido</th>
                          <th >Quantidade</th>
                          <th >Produto</th>
                          <th >Status</th>
                          <th >Opções</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($pedidos as $item)
                        <tr>
                            <td>{{$item->fk_cliente_id}} (<a href="{{ route('detalhesCliente', 
                              $item->id) }}">Informações</a>)</td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->Quantidade}}</td>
                            <td>{{$item->fk_produto_id}}</td>
                            <td>{{$item->Status}}</td>
                            <td >
                              <form action="{{ route('pedido', $item->id) }}" method="post">
                                 <a href="{{ route('detalhesDoPedido', 
                                $item->id) }}">Detalhes</a> | 
                                   <a href="{{ route('editarPedido', 
                                   $item->id) }}">Editar</a>
                                 @csrf
                                 
                                 <button type="submit" onclick="excluirPedido()">Excluir</button>
                              </form></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div> 
        <script>
          function excluirPedido()
          {
          alert("Pedido excluído com sucesso!");
          }
      </script>
@endsection