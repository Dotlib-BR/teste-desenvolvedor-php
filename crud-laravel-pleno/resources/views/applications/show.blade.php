@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Inscrição</h2>
    <p><strong>Job:</strong> {{ $application->vaga->titulo }}</p>
    <p><strong>Candidate:</strong> {{ $application->candidato->nome }}</p>
    <p><strong>Data de Inscrição:</strong> {{ $application->application_date->format('d/m/Y') }}</p>
    <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-primary">Editar</a>
    <form action="{{ route('applications.destroy', $application->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
</div>
@endsection
