@extends('layouts.app')

@section('template_title', 'Novo Cliente')

@section('content')
    
    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Novo Cliente</h2>
        </div>
        <div class="card-body p-5">
            <form action="{{route('clientes-store')}}" method="post">
            @csrf
                <legend class="font-small form-control text-center"><i class="fas fa-user-tie"></i> Dados Pessoais</legend>
                <div class="row form-group">
                    <div class="col-12 col-md-4 py-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Informe seu nome completo" value="{{old('nome')}}" class="form-control @error('nome') is-invalid @enderror">
                        @error('nome')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 py-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Informe seu email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 py-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf" name="cpf" placeholder="Informe seu CPF" value="{{old('cpf')}}" minlength="11" maxlength="11" class="form-control @error('cpf') is-invalid @enderror">
                        @error('cpf')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 col-md-4 py-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" id="celular" name="celular" placeholder="Informe seu Celular" value="{{old('celular')}}" maxlength="14" class="form-control @error('celular') is-invalid @enderror">
                        @error('celular')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 py-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" value="{{old('data_nascimento')}}" class="form-control @error('data_nascimento') is-invalid @enderror">
                        @error('data_nascimento')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 py-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="0" @if(old('status') == 0) selected @endif>Inativo</option>
                            <option value="1" @if(old('status') == 1) selected @endif>Ativo</option>
                            <option value="" @if(old('status') == '') selected @endif disabled>Escolha</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 text-end">
                    <a class="btn btn-dark" href="{{route('clientes-index')}}">Voltar</a>
                    <button class="btn btn-primary" type="submit">Novo</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection