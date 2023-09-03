@extends('layouts.app')

@section('content')
<a href="{{ route('jobs.create') }}">Adicionar Vaga</a>

<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jobs as $job)
        <tr>
            <td>{{ $job->title }}</td>
            <td>{{ $job->description }}</td>
            <td>{{ $job->type }}</td>
            <td>{{ $job->status }}</td>
            <td>
                <a href="{{ route('jobs.edit', $job->id) }}">Editar</a>
                <form action="{{ route('jobs.destroy', $job->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
