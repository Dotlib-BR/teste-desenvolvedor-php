@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Inscrição</h2>
    <form action="{{ route('applications.update', $application->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="vaga_id">Vaga:</label>
            <select name="vaga_id" class="form-control">
                @foreach($vagas as $vaga)
                    <option value="{{ $vaga->id }}" {{ $vaga->id === $application->vaga_id ? 'selected' : '' }}>
                        {{ $vaga->titulo }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="candidato_id">Candidato:</label>
            <select name="candidato_id" class="form-control">
                @foreach($candidatos as $candidato)
                    <option value="{{ $candidato->id }}" {{ $candidato->id === $application->candidato_id ? 'selected' : '' }}>
                        {{ $candidato->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="application_date">Data de Inscrição:</label>
            <input type="date" name="application_date" class="form-control" value="{{ $application->application_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
