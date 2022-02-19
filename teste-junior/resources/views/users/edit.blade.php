@extends('layouts.app')

@section('title', 'Edição')

@section('content')
  <div class="container mt-5">
    <h1>Atualize um Usuário</h1>
    <hr>
    <form action="{{route('users-update',['Id_cliente'=>$users->Id_cliente])}}" method="POST">
    @csrf
    @method('PUT')
      <div class="form-group">
          <fieldset id="EditarUs">
            <div class="form-group col-7">
              <p><label for="name">Primeiro Nome:</label> <input type="text" class="form-control mr-sm-2" name="name" placeholder="Digite o seu nome" value={{$users->name}} ></p>
            </div><br>

            <div class="form-group col-7">
              <p><label for="segundo_nome">Sobrenome:</label> <input type="text" class="form-control" name="segundo_nome" placeholder="Digite o seu SobreNome" value={{$users->segundo_nome}}></p>
            </div><br>

            <div class="form-group col-7">
              <p><label for="cpf">CPF:</label> <input type="text" class="form-control" name="cpf" placeholder="Digite o seu cpf"  maxlength="11" value={{$users->cpf}}></p>
            </div><br>

            <div class="form-group col-5">
              <p><label for="email">Email:</label> <input type="text" class="form-control" name="email" placeholder="Digite o seu email"  maxlength="10" value={{$users->email}}></p>
            </div><br>

            <div class="form-group">
            <input type="submit"  name="submit" class="btn btn-success" value="Alualizar">
            </div><br>

        </fieldset>
      </div>
    </form>
  </div>
@endsection
