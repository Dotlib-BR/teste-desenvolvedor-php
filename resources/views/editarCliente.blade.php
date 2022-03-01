@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/api/cliente"><- voltar</a>
                
                <h2 style="margin-top: 20px;">Editar dados do Cliente</h2>
                <br>
                <form method="post" action="{{route('editarCliente', $cliente->id )}}">
                @csrf
                <table class="table table-bordered">
                    <tr>
                      <td><strong>Nome</strong></td>
                      <td><input type="text"value='{{ $cliente->NomeCliente }}' name="nomeCliente"></td>
                    </tr>
                    <tr>
                      <td><strong>CPF</strong></td>
                      <td><input type="text"value='{{ $cliente->CPF }}' maxlength="11" name="cpfCliente"></td>
                    </tr>
                    <tr>
                      <td><strong>Email</strong></td>
                      <td><input type="text"value='{{ $cliente->Email }}' maxlength="10" name="emailCliente"></td>
                    </tr>
                  </table>
                  <button type="submit" class="btn btn-primary" onclick="alterarDados()">
                   Salvar Alterações
                </button>
                <a class="btn btn-danger" role="button" href="/api/cliente">Cancelar</a>
                </form> 
                </div>
            </div>
        </div>
        <script>
            function alterarDados()
            {
            alert("Dados do usuário alterados com sucesso!");
            }
        </script>
@endsection