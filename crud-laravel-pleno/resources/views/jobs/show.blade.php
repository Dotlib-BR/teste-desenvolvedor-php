@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da job</h2>
    <p><strong>Título:</strong> {{ $job->titulo }}</p>
    <p><strong>Descrição:</strong> {{ $job->descricao }}</p>
    <p><strong>Tipo:</strong> {{ $job->tipo }}</p>
    <p><strong>Status:</strong> {{ $job->status }}</p>
    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-primary">Editar</a>
    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
</div>
@endsection
