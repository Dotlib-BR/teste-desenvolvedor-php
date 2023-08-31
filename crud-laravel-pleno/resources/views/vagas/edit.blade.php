@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Vaga</h2>
    <form action="{{ route('vagas.update', $vaga->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" class="form-control" value="{{ $vaga->titulo }}">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" class="form-control" rows="3">{{ $vaga->descricao }}</textarea>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select name="tipo" class="form-control">
                <option value="CLT" {{ $vaga->tipo === 'CLT' ? 'selected' : '' }}>CLT</option>
                <option value="Pessoa Jurídica" {{ $vaga->tipo === 'Pessoa Jurídica' ? 'selected' : '' }}>Pessoa Jurídica</option>
                <option value="Freelancer" {{ $vaga->tipo === 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="Ativa" {{ $vaga->status === 'Ativa' ? 'selected' : '' }}>Ativa</option>
                <option value="Pausada" {{ $vaga->status === 'Pausada' ? 'selected' : '' }}>Pausada</option>
                <option value="Encerrada" {{ $vaga->status === 'Encerrada' ? 'selected' : '' }}>Encerrada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
