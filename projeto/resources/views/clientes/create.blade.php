@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Dados do Cliente
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{route('clientes.store')}}">
                            @csrf                               
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf">
                                </div>
                            </div>  
                            <button type="submit" class="btn btn-outline-secondary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
@endsection