@extends('layouts.app')

@section('content')
    <h1>Cadastrar Novo Candidato</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('candidatos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <!-- Seleção de vagas -->
        <div class="form-group">
            <label for="vagas">Selecione as Vagas</label>
            <select multiple class="form-control" id="vagas" name="vagas[]">
                @foreach ($vagas as $vaga)
                    <option value="{{ $vaga->id }}">{{ $vaga->nome }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar Candidato</button>
    </form>
@endsection
