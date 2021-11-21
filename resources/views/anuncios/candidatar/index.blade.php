@extends('layouts.dashboard')

@section('title', $title )

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    Lista de {{ Route::current()->getName() }}
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ Route::current()->getName() }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">

                            <form action="{{ route('anuncios.vagavinculo') }}" method="POST">
                                @csrf
                            <button type="submit" class="btn btn-danger btn-rounded mt-1" id="btn-candidato float-right">Candindate-se</button>
                            <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
                            <input type="hidden" name="usuario_id" value="{{auth()->user()->id }}">
                            <h4 class="float-right">Usuário: {{ auth()->user()->name }}</h4>
                            <ul class="list-group list-group-flush mt-5">
                                <li class="list-group-item">
                                    <b>Empresa:</b>{{ $anuncio->empresa->nome }} - <b>Tipo de contrato:</b>{{ $anuncio->tipo_vaga }}</li>
                                    <li class="list-group-item"><b>Título:</b>{{ $anuncio->titulo }}</li>
                                    <li class="list-group-item"><b>Descrião:</b>{{ $anuncio->descricao }}</li>
                                    <li class="list-group-item"><b>Até</b> {{ formatarValoresReal($anuncio->remuneracao) }} <b>R$</b></li>
                                    <li class="list-group-item">
                                        <b>Vaga aberta:</b> {{ formatarData($anuncio->created_at)}} até {{ date('d/m/Y', strtotime('now'));}}
                                    </li>
                                </ul>
                            </form>
                                <h4>
                                    <a href="{{ route('anuncios.list') }}" class="btn btn-warning btn-flat btn-addon btn-sm mt-2 m-l-5"><i class="ti-arrow-left"></i>Voltar</a>
                                </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

