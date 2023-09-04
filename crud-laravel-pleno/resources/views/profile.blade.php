@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">

    <div class="container mt-5">
        <h3>Perfil</h3>
        <ul>
            <li><strong>Nome:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
            <li><strong>Data de Criação:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</li>
            <li><strong>Último Login:</strong> {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('d/m/Y H:i') : 'N/A' }}</li>
        </ul>
    </div>
@endsection
