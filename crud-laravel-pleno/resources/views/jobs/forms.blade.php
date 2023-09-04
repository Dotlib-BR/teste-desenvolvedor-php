@extends('layouts.app')

@section('content')
<div class="container bg-dark text-light p-4">
    <h2 class="mb-4">{{ isset($job) ? 'Editar Vaga' : 'Criar Vaga' }}</h2>
    <form action="{{ isset($job) ? route('jobs.update', $job->id) : route('jobs.store') }}" method="POST">
        @csrf
        @if(isset($job))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="{{ $job->titulo ?? '' }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" class="form-control" rows="4">{{ $job->descricao ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select name="tipo" class="form-control">
                <option value="CLT">CLT</option>
                <option value="Pessoa Jurídica">Pessoa Jurídica</option>
                <option value="Freelancer">Freelancer</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="Ativa">Ativa</option>
                <option value="Pausada">Pausada</option>
                <option value="Encerrada">Encerrada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Voltar para Vagas</a>
    </form>
</div>
@endsection
