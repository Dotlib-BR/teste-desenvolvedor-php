@extends('layouts.dashboard')

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
                        <h4><a href="{{ route('anuncio.create') }}" class="btn btn-primary btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-plus"></i>Criar Anúncio</a></h4>
                        @if (session('msg'))
                            <div class="alert alert-success" id="msg">
                                {{ session('msg') }}
                            </div>
                        @endif
                    </div>
                    <div class="bootstrap-data-table-panel">
                        <div class="table-responsive">
                            <table id="table_id" class="display">
                                <thead>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Título</th>
                                        <th>Descricção</th>
                                        <th>Salário</th>
                                        <th>Status</th>
                                        <th>Regime de contratação</th>
                                        <th>Data de cadastrado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anuncios as $anuncio)
                                        <tr>
                                            <td>{{ $anuncio->empresa->nome }}</td>
                                            <td>{{ $anuncio->titulo }}</td>
                                            <td>{{ formatarTexto($anuncio->descricao) }}</td>
                                            <td>{{ formatarValoresReal($anuncio->remuneracao) }}</td>
                                            <td>{{ formatarStatusVaga($anuncio->ativo) }}</td>
                                            <td>{{ $anuncio->tipo_vaga }}</td>
                                            <td>{{ formatarData($anuncio->created_at) }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('anuncio.edit', $anuncio->id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="ti-pencil"></i></a>
                                                    <form action="{{ route('anuncio.delete', $anuncio->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Excluir"><i class="ti-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->
    </section>
</div>
@endsection

