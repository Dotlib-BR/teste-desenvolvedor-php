@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">

    <div class="container mt-5">
        <h3>Perfil</h3>
        <ul>
            <li><strong>Nome:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
            <!-- Você pode adicionar mais detalhes do perfil conforme necessário -->
        </ul>
    </div>
@endsection
