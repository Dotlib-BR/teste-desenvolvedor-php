@extends('layouts.app')

@section('content')


    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Cliente - Cadastro</h4>
            <p class="card-description"> Cadastrar Novo Cliente </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="forms-sample" method="POST" action="{{ route('client.post.create') }}">
                @csrf
                <div class="form-group row">
                    <label for="exampleInputName" class="col-sm-3 col-form-label">Nome</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Nome"
                            required minlength="3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputCPF" class="col-sm-3 col-form-label">CPF</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputCPF" name="cpf" placeholder="CPF Ex: 123.123.123-01"
                            required minlength="14" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail" class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="E-mail">
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Cadastrar</button>
            </form>
        </div>
    </div>

@endsection
