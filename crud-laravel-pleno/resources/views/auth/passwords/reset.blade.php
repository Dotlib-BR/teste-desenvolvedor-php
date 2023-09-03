@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reset Password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirm New Password:</label>
            <input type="password" name="password_confirmation" id="password-confirm" required>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection
