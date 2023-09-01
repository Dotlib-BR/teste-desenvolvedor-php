@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Inscrição</h2>
    <p><strong>Vaga:</strong> {{ $inscricao->vaga->titulo }}</p>
    <p><strong>Candidato:</strong> {{ $inscricao->candidato->nome }}</p>
    <p><strong>Data de Inscrição:</strong> {{ $inscricao->data_inscricao->format('d/m/Y') }}</p>
    <a href="{{ route('inscricaos.edit', $inscricao->id) }}" class="btn btn-primary">Editar</a>
    <form action="{{ route('inscricaos.destroy', $inscricao->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
</div>
@endsection
