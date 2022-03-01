@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/api/cliente"><- voltar</a>
                
                <h2 style="margin-top: 20px;">Detalhes do Produto</h2>
                <br>

                <table class="table table-bordered">
                    <tr>
                      <td><strong>Código</strong></td>
                      <td> {{ $produto->id }}</td>
                    </tr>
                    <tr>
                      <td><strong>Nome do Produto</strong></td>
                      <td> {{ $produto->NomeProduto }}</td>
                    </tr>
                    <tr>
                      <td><strong>Código de Barras</strong></td>
                      <td> {{ $produto->CodBarras }}</td>
                    </tr>
                    <tr>
                      <td><strong>Valor Unitário</strong></td>
                      <td> {{ $produto->ValorUnitario }}</td>
                    </tr>
                  </table>

                </div>
            </div>
        </div>
@endsection