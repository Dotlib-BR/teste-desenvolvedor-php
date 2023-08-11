@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de Vagas Disponíveis</h2>

        @if(count($vagas) > 0)
            <ul>
                @foreach($vagas as $vaga)
                    <li>
                        {{ $vaga->nome }} - {{ $vaga->tipo }} - {{ $vaga->status }}
                        <a href="{{ route('candidatos.create', ['vaga' => $vaga->id]) }}">Candidatar-se</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Não há vagas disponíveis no momento.</p>
        @endif
    </div>
@endsection
