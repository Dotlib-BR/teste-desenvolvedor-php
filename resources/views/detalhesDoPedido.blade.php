@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/api/pedido"><- voltar</a>
                
                <h2 style="margin-top: 20px;">Detalhes do Pedido</h2>
                <br>

                <table class="table table-bordered">
                    <tr>
                      <td><strong>Código do Pedido</strong></td>
                      <td> {{ $pedido->id }}</td>
                    </tr>
                    <tr>
                      <td><strong>Produto</strong></td>
                      <td> {{ $pedido->fk_produto_id }}</td>
                    </tr>
                    <tr>
                      <td><strong>Quantidade</strong></td>
                      <td> {{ $pedido->Quantidade }}</td>
                    </tr>
                    <tr>
                      <td><strong>Valor Total</strong></td>
                      <td></td>
                    </tr>
                  </table>

                </div>
            </div>
        </div>
@endsection