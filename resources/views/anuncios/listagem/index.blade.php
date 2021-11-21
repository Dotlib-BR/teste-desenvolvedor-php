@extends('layouts.dashboard')

@section('title', $title)

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
            @foreach ($anuncios as $anuncio)

                <div class="col-6">
                    <div class="card mb-3" style="max-width: 800px">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <b>Empresa:</b>{{ $anuncio->nome_empresa }} - <b>Tipo de contrato:</b>{{ $anuncio->tipo_vaga }}</li>
                                        <li class="list-group-item"><b>Título:</b>{{ $anuncio->titulo }}</li>
                                        <li class="list-group-item"><b>Descrião:</b>{{ $anuncio->descricao }}</li>
                                        <li class="list-group-item"><b>Até</b> {{ formatarValoresReal($anuncio->remuneracao) }} <b>R$</b></li>
                                        <li class="list-group-item">
                                            <b>Vaga aberta:</b> {{ formatarData($anuncio->created_at)}} até {{ date('d/m/Y', strtotime('now'));}}
                                            <a href="{{ route('anuncios.check',['id'=> $anuncio->id])}}" class="btn btn-primary btn-rounded mt-1 float-right" id="btn-candidato">Candidate-se</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-5">
                {!! $anuncios->links() !!}
            </div>
        </section>
    </div>
@endsection
