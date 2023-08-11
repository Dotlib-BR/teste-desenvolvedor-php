@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Bem-vindo à Plataforma de Oportunidades de Emprego</h1>
        <p>Escolha uma das opções abaixo para começar:</p>
        <div class="row option">
            <div class="col-md-6">
                <a href="{{ route('vagas.index') }}" class="btn btn-primary btn-lg">Criar ou Editar Vagas Para Contratação</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('listar-vagas') }}" class="btn btn-success btn-lg">Sou Candidato, Quero Aplicar para uma Vaga!</a>
            </div>
        </div>
    </div>
@endsection
