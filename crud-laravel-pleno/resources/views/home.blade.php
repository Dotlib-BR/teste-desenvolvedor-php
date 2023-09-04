@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Bem-vindo, {{ auth()->user()->name }}!</p>

                    @if (auth()->user()->access_level == 'admin')

                        <a href="{{ route('jobs.index') }}">Ver Todas as Vagas</a>
                        <a href="{{ route('dashboard') }}">Dashboard Administrativo</a>
                        <!-- ... -->
                    @else

                        <a href="{{ route('jobs.index') }}">Ver Vagas</a>
                        <a href="{{ route('applications') }}">Minhas Candidaturas</a>
                        <!-- ... -->
                    @endif

                    <a href="{{ route('profile.edit') }}">Meu Perfil</a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
