@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    @guest
                        <p>{{ __('Welcome to our platform!') }}</p>
                        <p><a href="{{ route('register') }}">Register</a> or <a href="{{ route('login') }}">Login</a></p>
                    @else
                        <p>{{ __('You are logged in!') }}</p>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('candidates.index') }}">Candidates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}">Profile</a> <!-- A rota 'profile' precisa ser definida -->
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
