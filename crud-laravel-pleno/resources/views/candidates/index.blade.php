@extends('layouts.app')

@section('content')
<a href="{{ route('candidates.create') }}">Adicionar Candidato</a>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Experiência</th>
            <th>Habilidades</th>
            <th>Disponibilidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($candidates as $candidate)
        <tr>
            <td>{{ $candidate->name }}</td>
            <td>{{ $candidate->email }}</td>
            <td>{{ $candidate->experience }}</td>
            <td>{{ $candidate->skills }}</td>
            <td>{{ $candidate->availability }}</td>
            <td>
                <a href="{{ route('candidates.edit', $candidate->id) }}">Editar</a>
                <form action="{{ route('candidates.destroy', $candidate->id) }}" method="post">
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
