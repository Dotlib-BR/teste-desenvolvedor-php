@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Usuário</h1>
    <form method="POST" action="{{ route('admin.addUser') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Senha:</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</div>
@endsection
