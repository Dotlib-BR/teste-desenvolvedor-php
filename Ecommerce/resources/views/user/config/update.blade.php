@extends('layouts.master')
@section('title', 'Configuração de Usuario')
@section('content')
    @if (Session::get('error'))
        <h3>{{ Session::get('error') }}</h3>
    @endif
    @if (Session::get('success'))
        <h3>{{ Session::get('success') }}</h3>
    @endif
    <form action="{{ route('validateConfig') }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <input type="text" name="name" value="{{ old('nome') ?? $currentUser->name }}" placeholder="Nome">
            <p>@error('nome') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="text" name="last_name" value="{{ old('sobrenome') ?? $currentUser->last_name}}" placeholder="Sobrenome">
            <p>@error('sobrenome') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="email" name="email" value="{{ old('email') ?? $currentUser->email}}" placeholder="E-mail">
            <p>@error('email') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="password" name="password" placeholder="Senha">
            <p>@error('senha') {{ $message }} @enderror</p>
        </div>
        <div>
            <input type="number" disabled name="cpf" value="{{ $currentUser->document }}" placeholder="CPF">
            <p>@error('cpf') {{ $message }} @enderror</p>
        </div>
        <button type="submit">
            Atualizar
        </button>
    </form>
@endsection