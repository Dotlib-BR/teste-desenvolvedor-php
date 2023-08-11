@extends('layouts.app')

@section('content')
    <h1>Vagas para as quais você se candidatou</h1>

    <ul>
        @forelse ($candidato->vagas as $vaga)
            <li>
                <strong>{{ $vaga->nome }}</strong>
                <p>Tipo: {{ $vaga->tipo }}</p>
                <p>Status: {{ $vaga->status }}</p>
                <p>Email: {{ $vaga->email }}</p>
            </li>
        @empty
            <p>Você ainda não se candidatou a nenhuma vaga.</p>
        @endforelse
    </ul>
@endsection
