@extends('layouts.app')

@section('title', 'Criação')

@section('content')
  <div class="container mt-5">
    <h1>Crie um novo Usuário</h1>
    <hr>
    <form action="{{route('users-store')}}" method="POST">
    @csrf
      <div class="form-group">
          <fieldset id="criarUs">
            <div class="form-group col-7">
              <p><label for="name">Primeiro Nome:</label> <input type="text" class="form-control mr-sm-2" name="name" placeholder="Digite o seu nome"  ></p>
            </div><br>

            <div class="form-group col-7">
              <p><label for="segundo_nome">Sobrenome:</label> <input type="text" class="form-control" name="segundo_nome" placeholder="Digite o seu SobreNome"></p>
            </div><br>

            <div class="form-group col-7">
              <p><label for="cpf">CPF:</label> <input type="text" class="form-control" name="cpf" placeholder="Digite o seu cpf"  maxlength="11"></p>
            </div><br>

            <div class="form-group col-5">
              <p><label for="email">Email:</label> <input type="text" class="form-control" name="email" placeholder="Digite o seu email"  maxlength="10"></p>
            </div><br>

            <div class="form-group">
            <input type="submit"  name="submit" class="btn btn-primary">
            </div><br>
        </fieldset>
      </div>
    </form>
  </div>
@endsection
