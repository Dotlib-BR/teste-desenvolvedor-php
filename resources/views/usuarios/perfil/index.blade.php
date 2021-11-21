@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 p-r-0 title-margin-right">
                <div class="page-header">
                    <div class="page-title">

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
                            <h4> <a href="{{ route('usuarios') }}"
                                    class="btn btn-warning btn-flat btn-addon btn-sm m-b-10 m-l-5"><i
                                        class="ti-arrow-left"></i>Voltar</a></h4>
                                        @if (session('user_update'))
                                        <div class="alert alert-success" id="msg">
                                            {{ session('user_update') }}
                                        </div>
                                    @endif

                        </div>

                        @component('components.form_isMe', ['usuario' => $info])

                        @endcomponent

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
