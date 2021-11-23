@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4> <a href="{{ route('announcement.adm.index') }}"
                            class="btn btn-warning btn-flat btn-addon btn-sm m-b-10 m-l-5"><i
                                class="ti-arrow-left"></i>Voltar</a></h4>
                </div>
                <div class="bootstrap-data-table-panel">
                    @if (session('msg'))
                        <div class="alert alert-success" id="msg">
                            {{ session('msg') }}
                        </div>
                    @endif
                    @component('components.form_anuncio', ['companies' => $companies, 'tipo_contrato' => $tipo_contrato,
                        'announcement' => $announcement??[], 'active' => $active??[]])
                    @endcomponent

                </div>
            </div>
        </div>
    </div>
@endsection
