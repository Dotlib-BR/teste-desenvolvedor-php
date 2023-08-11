@extends('layouts.app')

@section('content')
    <h1>Detalhes do Candidato</h1>

    <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9">{{ $candidato->id }}</dd>

        <dt class="col-sm-3">Nome</dt>
        <dd class="col-sm-9">{{ $candidato->nome }}</dd>

        <dt class="col-sm-3">CPF</dt>
        <dd class="col-sm-9">{{ $candidato->cpf }}</dd>

        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9">{{ $candidato->email }}</dd>

        <dt class="col-sm-3">Vagas Candidatadas</dt>
        <dd class="col-sm-9">
            @foreach ($candidato->vagas as $vaga)
                <p>{{ $vaga->nome }}</p>
            @endforeach
        </dd>
    </dl>

    <a href="{{ route('candidatos.edit', $candidato->id) }}" class="btn btn-primary">Editar</a>
    <form action="{{ route('candidatos.destroy', $candidato->id) }}" method="POST" style="display: inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
@endsection
