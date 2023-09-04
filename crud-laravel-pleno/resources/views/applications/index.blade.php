@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Inscrições</h2>
    
    @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('applications.create') }}" class="btn btn-success mt-3">Nova Inscrição</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vaga</th>
                <th>Candidato</th>
                <th>Data de Inscrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
            <tr>
                <td>{{ $application->id }}</td>
                <td>{{ $application->job->titulo }}</td> 
                <td>{{ $application->candidate->nome }}</td>
                <td>{{ is_string($application->application_date) ? $application->application_date : $application->application_date->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Voltar para o Dashboard</a>
</div>
@endsection
