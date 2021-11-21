@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 p-r-0 title-margin-right">
                <div class="page-header">
                    <div class="page-title">
                     @if (isset($anuncio))
                        @php
                            $anuncio = $anuncio;
                        @endphp
                         Editar Anúncio
                     @else
                        @php
                            $anuncio = array();
                        @endphp
                         Cadastrar Anúncio
                     @endif
                    </div>
                </div>
            </div>
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
        </div>
        <section id="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title">
                            <h4> <a href="{{ route('anuncios') }}"
                                    class="btn btn-warning btn-flat btn-addon btn-sm m-b-10 m-l-5"><i
                                        class="ti-arrow-left"></i>Voltar</a></h4>
                        </div>
                        <div class="bootstrap-data-table-panel">
                            @if (session('msg'))
                                <div class="alert alert-success" id="msg">
                                    {{ session('msg') }}
                                </div>
                            @endif

                            @component('components.form_anuncio', ['empresas' => $empresas, 'tipo_contrato' =>
                                $tipo_contrato,'anuncio'=>$anuncio])
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
