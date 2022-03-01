@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/api/pedido"><- voltar</a>
                
                <h2 style="margin-top: 20px;">Detalhes do Cliente</h2>
                <br>

                <table class="table table-bordered">
                    <tr>
                      <td><strong>Código</strong></td>
                      <td> {{ $cliente->id }}</td>
                    </tr>
                    <tr>
                      <td><strong>Nome</strong></td>
                      <td> {{ $cliente->NomeCliente }}</td>
                    </tr>
                    <tr>
                      <td><strong>CPF</strong></td>
                      <td> {{ $cliente->CPF }}</td>
                    </tr>
                    <tr>
                      <td><strong>Email</strong></td>
                      <td> {{ $cliente->Email }}</td>
                    </tr>
                  </table>

                </div>
            </div>
        </div>
@endsection