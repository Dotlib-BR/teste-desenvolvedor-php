@extends('layouts.app')

@section('title', 'Listagem')

@section('content')
<div class="container mt-5" >
  <div class="row">
      <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
          <h1>Listagem de Usuários</h1>
      </div>
      <div class="col-sm-2">
          <a href="/users/create" class="btn btn-success">Novo Usuário</a>
      </div>
  </div>
    <table class="table mt-4">
    <thead>
        <th>#</th>
        <th>@sortablelink('name', 'Primeiro nome')</th>
        <th>@sortablelink('segundo_nome', 'Sobre Nome')</th>
        <th>@sortablelink('cpf', 'CPF')</th>
        <th>@sortablelink('email', 'email')</th>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <th>{{$user->Id_cliente}}</th>
        <th>{{$user->name}}</th>
        <th>{{$user->segundo_nome}}</th>
        <th>{{$user->cpf}}</th>
        <th>{{$user->email}}</th>


        <th class="d-flex">
          <a href="{{route('users-edit',['Id_cliente'=>$user->Id_cliente])}}" class="btn btn-primary me-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
          </a>

         <form action="{{route('users-destroy',['Id_cliente'=>$user->Id_cliente])}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit"class="btn btn-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
          </button>
         </form>
        </th>
      </tr>
      @endforeach
    </tbody>
  </table>
  <table class="table mt-4">
    <thead>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
        <h1>Filtros</h1>
    </div>
    <th>
      <form class="form-inline" method="GET">
        <div class="form-group mb-2">
          <input type="text" class="form-control" id="filter1" name="filter1" placeholder="Nome..." value="{{$filter1}}">
        </div>
        <button type="submit" class="btn btn-success mb-2">Filtrar</button>
      </form>
      </th>

      <th>
        <form class="form-inline" method="GET">
          <div class="form-group mb-2">
            <input type="text" class="form-control" id="filter2" name="filter2" placeholder="SobreNome..." value="{{$filter2}}">
          </div>
          <button type="submit" class="btn btn-success mb-2">Filtrar</button>
        </form>
        </th>

        <th>
          <form class="form-inline" method="GET">
            <div class="form-group mb-2">
              <input type="text" class="form-control" id="filter3" name="filter3" placeholder="CPF..." value="{{$filter3}}">
            </div>
            <button type="submit" class="btn btn-success mb-2">Filtrar</button>
          </form>
          </th>

          <th>
            <form class="form-inline" method="GET">
              <div class="form-group mb-2">
                <input type="text" class="form-control" id="filter4" name="filter4" placeholder="EMAIL..." value="{{$filter4}}">
              </div>
              <button type="submit" class="btn btn-success mb-2">Filtrar</button>
            </form>
            </th>
    </thead>
  </table>
  <div class="d-flex justify-content-center mt-5">
    {!! $users->appends(Request::except('page'))->render() !!}
  </div>
</div>
@endsection
