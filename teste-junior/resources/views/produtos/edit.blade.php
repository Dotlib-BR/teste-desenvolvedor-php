@extends('layouts.app')

@section('title', 'Edição')

@section('content')
  <div class="container mt-5">
    <h1>Atualize um Produto</h1>
    <hr>
    <form action="{{route('produtos-update',['Id_produto'=>$produtos->Id_produto])}}" method="POST">
    @csrf
    @method('PUT')
      <div class="form-group">
          <fieldset id="EditarUs">
            <div class="form-group col-7">
              <p><label for="Nome_produto">Nome Do Produto:</label> <input type="text" class="form-control mr-sm-2" name="Nome_produto" placeholder="Digite o nome do produto" value={{$produtos->Nome_produto}} ></p>
            </div><br>

            <div class="form-group col-7">
              <p><label for="CodBarras">Código de Barra:</label> <input type="text" class="form-control" name="CodBarras" placeholder="Digite o Código de barras" value={{$produtos->CodBarras}}></p>
            </div><br>

            <div class="form-group col-7">
              <p><label for="ValorUnitario">CPF:</label> <input type="text" class="form-control" name="ValorUnitario" placeholder="Digite o valor unitário"  maxlength="11" value={{$produtos->ValorUnitario}}></p>
            </div><br>


            <div class="form-group">
            <input type="submit"  name="submit" class="btn btn-success" value="Alualizar">
            </div><br>

        </fieldset>
      </div>
    </form>
  </div>
@endsection
