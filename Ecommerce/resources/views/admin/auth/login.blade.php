@extends('layouts.masterOut')
@section('title', 'Admin - login')
@section('content')
<h1>Login Admin</h1>

<form action="{{ route('validateLoginAdmin') }}" method="POST">
    @csrf
    <input type="email" name="email">
    <input type="password" name="password">
    <input type="submit" value="Entrar">
</form>
@endsection