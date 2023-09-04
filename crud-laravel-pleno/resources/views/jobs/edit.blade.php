@extends('layouts.app')

@section('content')
<div class="container bg-dark text-light p-4">
    <h2 class="mb-4">Editar Vaga</h2>
    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" class="form-control" value="{{ $job->titulo }}">
        </div>
        
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" class="form-control" rows="4">{{ $job->descricao }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select name="tipo" class="form-control">
                <option value="CLT" {{ $job->tipo == 'CLT' ? 'selected' : '' }}>CLT</option>
                <option value="Pessoa Jurídica" {{ $job->tipo == 'Pessoa Jurídica' ? 'selected' : '' }}>Pessoa Jurídica</option>
                <option value="Freelancer" {{ $job->tipo == 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="Ativa" {{ $job->status == 'Ativa' ? 'selected' : '' }}>Ativa</option>
                <option value="Pausada" {{ $job->status == 'Pausada' ? 'selected' : '' }}>Pausada</option>
                <option value="Encerrada" {{ $job->status == 'Encerrada' ? 'selected' : '' }}>Encerrada</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
