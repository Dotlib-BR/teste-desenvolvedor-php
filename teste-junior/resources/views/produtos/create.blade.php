@extends('layouts.app')

@section('title', 'Criação')

@section('content')
  <div class="container mt-5">
    <h1>Crie um novo Produto</h1>
    <hr>
    <form action="{{route('produtos-store')}}" method="POST">
    @csrf
      <div class="form-group">
          <fieldset id="criarUs">
            <div class="form-group col-7">
              <p><label for="name">Nome do Produto:</label> <input type="text" class="form-control mr-sm-2" name="Nome_produto" placeholder="Digite o nome do produto"  ></p>
            </div><br>

            <div class="form-group col-7">
              <p><label for="CodBarras">Código de Barra:</label> <input type="text" class="form-control" name="CodBarras" placeholder="Digite o CodBarras"></p>
            </div><br>

            <div class="form-group col-7">
              <p><label for="ValorUnitario">Valor Unitário:</label> <input type="text" class="form-control" name="ValorUnitario" placeholder="Digite o valor Unitário"  maxlength="11"></p>
            </div><br>



            <div class="form-group">
            <input type="submit"  name="submit" class="btn btn-primary">
            </div><br>
        </fieldset>
      </div>
    </form>
  </div>
@endsection
