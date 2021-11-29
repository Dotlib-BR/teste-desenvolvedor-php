@extends('layouts.app')

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
            @if(Auth::check() && Auth::user()->perfil == "candidato")
            <div class="card mt-2">
                <div class="card-header">
                    <h5>Aplicar para essa vaga</h5>
                </div>

                <div class="card-body">
                    @guest
                        <p>Você não está logado, é necessário estar autenticado para poder aplicar para a vaga</p>
                        <p> <a href="{{ route('auth.login')}}">Fazer Login</a>. Não tem login? faça o cadastro <a href="{{ route('auth.candidato.registro') }}">aqui</a></p>
                    @else
                        <p>Você está logado como <span class="text-primary">{{auth()->user()->nome}}</span> </p>
                        <hr class="w-50">
                        <p>Se deseja se candidatar a essa vaga, anexe o seu curriculo e clique em aplicar </p>
                        <form method="POST" action="{{ route('site.vaga.inscrever', $vaga->slug) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <input class="form-control" type="file" id="formFile" name="curriculo" required>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <button class="btn btn-primary"><span>Aplicar</span> <i class="fas fa-check"></i></button>
                                </div>
                            </div>
                        </form>
                    @endguest
                </div>
            </div>
            @endif
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
