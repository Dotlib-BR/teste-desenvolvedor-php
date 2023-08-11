@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de Candidatos</h2>

        @if(count($candidatos) > 0)
            <ul>
                @foreach($candidatos as $candidato)
                    <li>
                        {{ $candidato->nome }} - {{ $candidato->cpf }} - {{ $candidato->email }} -
                        @if($candidato->vaga)
                            Vaga: {{ $candidato->vaga->nome }}
                        @else
                            Sem Vaga
                        @endif
                        <!-- Botões de Ação -->
                        <a href="{{ route('vagas.candidatos.create', ['vaga' => $candidato->vaga_id]) }}">Criar</a>
                        <a href="{{ route('vagas.candidatos.edit', ['vaga' => $candidato->vaga_id, 'candidato' => $candidato->id]) }}">Editar</a>
                        <form action="{{ route('vagas.candidatos.destroy', ['vaga' => $candidato->vaga_id, 'candidato' => $candidato->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Não há candidatos disponíveis.</p>
        @endif
    </div>
@endsection
