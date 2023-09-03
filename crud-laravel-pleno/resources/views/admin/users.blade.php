@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Usuários</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-warning">Editar</a>
                        <!-- Botão para excluir usuário, etc. -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
