@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Novo Clientes</h1>

                <form action="{{ route('customers.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <button class="btn btn-outline-primary">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
