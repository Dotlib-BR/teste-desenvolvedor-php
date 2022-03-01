@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/api/cliente"><- voltar</a>
                
                <h2 style="margin-top: 20px;">Editar dados do Produto</h2>
                <br>
                <form method="post" action="{{route('editarProduto', $produto->id )}}">
                @csrf
                <table class="table table-bordered">
                    <tr>
                      <td><strong>Nome do Produto</strong></td>
                      <td><input type="text"value='{{  $produto->NomeProduto }}' name="nomeProduto"></td>
                    </tr>
                    <tr>
                      <td><strong>Código de Barras</strong></td>
                      <td><input type="text"value='{{ $produto->CodBarras }}' maxlength="13" name="cBarras"></td>
                    </tr>
                    <tr>
                      <td><strong>Valor Unitário</strong></td>
                      <td><input type="text"value='{{ $produto->ValorUnitario }}' name="valorU"></td>
                    </tr>
                  </table>
                  <button type="submit" class="btn btn-primary" onclick="alterarDados()">
                   Salvar Alterações
                </button>
                <a class="btn btn-danger" role="button" href="/api/produto">Cancelar</a>
                </form> 
                </div>
            </div>
        </div>
        <script>
            function alterarDados()
            {
            alert("Dados do produto alterados com sucesso!");
            }
        </script>
@endsection