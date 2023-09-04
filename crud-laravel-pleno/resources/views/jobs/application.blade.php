@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vagas Disponíveis para Inscrição</h2>
    <div class="row">
        @foreach($jobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->titulo }}</h5>
                        <p class="card-text">{{ $job->descricao }}</p>
                        <p class="card-text"><strong>Tipo:</strong> {{ $job->tipo }}</p>
                        <p class="card-text"><strong>Status:</strong> {{ $job->status }}</p>
                        <form method="POST" action="{{ route('jobs.inscrever', $job->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Inscrever-se</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
