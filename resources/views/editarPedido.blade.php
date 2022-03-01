@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/api/pedido"><- voltar</a>
                
                <h2 style="margin-top: 20px;">Editar dados do Pedido</h2>
                <br>
                <form method="post" action="{{route('editarPedido', $pedido->id )}}">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Código do Pedido</strong></td>
                        <td>{{ $pedido->id }}</td>
                      </tr>
                    <tr>
                    <tr>
                        <td><strong>Cliente</strong></td>
                        <td>{{ $pedido->fk_cliente_id }}</td>
                      </tr>
                    <tr>
                      <td><strong>Produto</strong></td>
                      <td>{{  $pedido->fk_produto_id }}</td>
                    </tr>
                    <tr>
                      <td><strong>Quantidade</strong></td>
                      <td>{{ $pedido->Quantidade }}</td>
                    </tr>
                    <tr>
                        <td><strong>Data da compra</strong></td>
                        <td>{{ $pedido->DtPedido }}</td>
                      </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td><input type="text"value='{{ $pedido->Status }}' maxlength="10" name="sts"></td>
                      </tr>
                    <tr>
                      <td><strong>Valor Total</strong></td>
                      <td>R$ {{ $pedido->Total }}</td>
                    </tr>
                  </table>
                  <button type="submit" class="btn btn-primary" onclick="alterarDados()">
                   Salvar Alterações
                </button>
                <a class="btn btn-danger" role="button" href="/api/pedido">Cancelar</a>
                </form> 
                </div>
            </div>
        </div>
        <script>
            function alterarDados()
            {
            alert("Dados do pedido alterados com sucesso!");
            }
        </script>
@endsection