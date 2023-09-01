@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Inscrições</h2>
    <a href="{{ route('inscricaos.create') }}" class="btn btn-success">Nova Inscrição</a>
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
            @foreach($inscricaos as $inscricao)
            <tr>
                <td>{{ $inscricao->id }}</td>
                <td>{{ $inscricao->vaga->titulo }}</td>
                <td>{{ $inscricao->candidato->nome }}</td>
                <td>{{ $inscricao->application_date->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('inscricaos.edit', $inscricao->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('inscricaos.destroy', $inscricao->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
