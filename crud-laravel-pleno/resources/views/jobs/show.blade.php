@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Vaga</h2>
    <p><strong>Título:</strong> {{ $vaga->titulo }}</p>
    <p><strong>Descrição:</strong> {{ $vaga->descricao }}</p>
    <p><strong>Tipo:</strong> {{ $vaga->tipo }}</p>
    <p><strong>Status:</strong> {{ $vaga->status }}</p>
    <a href="{{ route('vagas.edit', $vaga->id) }}" class="btn btn-primary">Editar</a>
    <form action="{{ route('vagas.destroy', $vaga->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
</div>
@endsection
