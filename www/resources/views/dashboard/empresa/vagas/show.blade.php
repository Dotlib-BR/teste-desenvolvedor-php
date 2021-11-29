@extends('layouts.empresa')

@section('content')
<div class="container">
    <div class="row align-items-start">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{$vaga->titulo}}</h3>
                    <small class="text-info my-1"> <i class="fa fa-file-code-o small"></i> {{$vaga->empresa->nome}}</small>
                </div>
                <div class="card-body py-3">
                    <h5>Descrição da vaga: </h5>
                    {!! $vaga->descricao !!}
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-2">
                <div class="card-header">
                    <h3>Detalhes</h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Nivel: {{$vaga->nivel}}</li>
                        <li>Categoria: {{$vaga->categoria}}</li>
                        <li>Regime: {{$vaga->regime}}</li>
                        <li>Salário: R$ {{number_format($vaga->salario, 2, ',','.')}}</li>
                        <li>Local: {{ $vaga->empresa->endereco }}</li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Tecnologias</h3>
                </div>
                <div class="card-body">
                    <ul class="list-inline my-0">
                        @foreach($vaga->tags->random(4) as $tag)
                            <li class="list-inline-item"> <span class="badge rounded-pill bg-primary ">{{$tag->nome}}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
