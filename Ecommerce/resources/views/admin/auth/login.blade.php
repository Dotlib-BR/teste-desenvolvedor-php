@extends('layouts.masterOut')
@section('title', 'Admin - login')
@section('content')

<section class="card login__form">
    <div class="card-body">
        <h3 class="card-title text-center">Login Admin</h3>
        <div class="card-text">
            <form action="{{ route('validateLoginAdmin') }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <label for="email">E-mail</label>
                    <input placeholder="E-mail" type="email" name="email" class="form-control form-control-sm" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input placeholder="Password" type="password" name="password" class="form-control form-control-sm" id="password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</section>
@endsection