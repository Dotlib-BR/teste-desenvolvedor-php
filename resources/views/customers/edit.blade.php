@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Novo Clientes</h1>

                <form action="{{ route('customers.update', $customer) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $customer->name) }}" placeholder="Nome" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" value="{{ old('cpf', $customer->cpf) }}" placeholder="Somente números" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $customer->email) }}" placeholder="E-mail">
                    </div>
                    <button class="btn btn-outline-primary">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
