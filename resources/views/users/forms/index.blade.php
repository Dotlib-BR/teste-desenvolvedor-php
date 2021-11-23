@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4> <a href="{{ route('user.adm.index') }}"
                            class="btn btn-warning btn-flat btn-addon btn-sm m-b-10 m-l-5"><i
                                class="ti-arrow-left"></i>Voltar</a></h4>
                    @if (session('user_success'))
                        <div class="alert alert-success" id="msg">
                            {{ session('user_success') }}
                        </div>
                    @endif
                    @if (session('user_update'))
                        <div class="alert alert-success" id="msg">
                            {{ session('user_update') }}
                        </div>
                    @endif

                </div>
                @component('components.form_usuario', ['usuario' => $usuario])

                @endcomponent

            </div>
        </div>
    </div>
@endsection
