@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Usuário</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
