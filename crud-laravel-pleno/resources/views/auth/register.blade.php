@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- ... outros campos como nome, etc ... -->

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
