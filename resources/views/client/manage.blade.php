@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @component('components.card')    
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h3 class="mb-0">{{ ! isset($client) ? 'Cadastrar' : 'Atualizar' }} Cliente</h3>
                        </div>

                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-primary" href="{{ route('clients.index') }}">Listar Clientes</a>
                        </div>
                    </div>
                @endcomponent      
            </div>

            <div class="col-12">
                @component('components.card')    
                    <form action="{{ ! isset($client) ? route('clients.store') : route('clients.update', $client->id) }}" method="post">
                        @csrf

                        @isset($client)
                            @method('PUT')
                        @endisset

                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ old('name', $client->name ?? '') }}" placeholder="Digite o nome">
                                    @include('includes.form.validate', ['name' => 'name'])
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input id="cpf" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" type="text" name="cpf" value="{{ old('cpf', $client->cpf ?? '') }}" placeholder="Digite o CPF">
                                    @include('includes.form.validate', ['name' => 'cpf'])
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email', $client->email ?? '') }}" placeholder="Digite o email">
                                    @include('includes.form.validate', ['name' => 'email'])
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group text-right mb-0">
                                    @include('includes.form.submit')
                                </div>
                            </div>
                        </div>
                    </form>
                @endcomponent      
            </div>
        </div>
    </div>
@endsection