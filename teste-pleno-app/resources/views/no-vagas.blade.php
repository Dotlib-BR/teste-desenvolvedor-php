@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Oops, não há vagas nesse momento!</h1>
        <p>Por favor, verifique novamente mais tarde.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
    </div>
@endsection
