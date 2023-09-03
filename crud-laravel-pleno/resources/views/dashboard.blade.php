<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ auth()->user()->name }}!</h2>
    <!-- ... conteúdo do dashboard ... -->
</div>
@endsection
