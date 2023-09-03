@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes do Candidato</h2>
    <p><strong>Nome:</strong> {{ $candidate->name }}</p>
    <p><strong>E-mail:</strong> {{ $candidate->email }}</p>
    <p><strong>Experiência:</strong> {{ $candidate->experience }}</p>
    <p><strong>Habilidades:</strong> {{ $candidate->skills }}</p>
    <p><strong>Disponibilidade:</strong> {{ $candidate->availability }}</p>
    <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-primary">Editar</a>
    <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
</div>
@endsection
