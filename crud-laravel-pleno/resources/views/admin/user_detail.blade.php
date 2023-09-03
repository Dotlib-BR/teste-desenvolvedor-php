@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Usuário</h1>
    <hr>

    <div class="card">
        <div class="card-header">Informações do Usuário</div>
        <div class="card-body">
            <p><strong>Nome:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Data de Criação:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Última Atualização:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.users') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
