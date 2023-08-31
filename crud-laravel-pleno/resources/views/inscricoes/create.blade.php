@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Criar Inscrição</h2>
    <form action="{{ route('inscricoes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="vaga_id">Vaga:</label>
            <select name="vaga_id" class="form-control">
                @foreach($vagas as $vaga)
                    <option value="{{ $vaga->id }}">{{ $vaga->titulo }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="candidato_id">Candidato:</label>
            <select name="candidato_id" class="form-control">
                @foreach($candidatos as $candidato)
                    <option value="{{ $candidato->id }}">{{ $candidato->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="data_inscricao">Data de Inscrição:</label>
            <input type="date" name="data_inscricao" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
