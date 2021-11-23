@extends('layouts.dashboard')

@section('title', $title)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">

                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <form action="{{ route('announcement.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-rounded mt-1"
                                id="btn-candidato float-right">Candindate-se</button>
                            <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <h4 class="float-right">Usuário: {{ auth()->user()->name }}</h4>
                            <ul class="list-group list-group-flush mt-5">
                                <li class="list-group-item">
                                    <b>Empresa:</b>{{ $announcement->company->name }} - <b>Tipo de
                                        contrato:</b>{{ $announcement->name }}
                                </li>
                                <li class="list-group-item"><b>Título:</b>{{ $announcement->title }}</li>
                                <li class="list-group-item"><b>Descrião:</b>{{ $announcement->description }}</li>
                                <li class="list-group-item"><b>Até</b>
                                    {{ formatarValoresReal($announcement->remuneration) }} <b>R$</b></li>
                                <li class="list-group-item">
                                    <b>Vaga aberta:</b> {{ formatarData($announcement->created_at) }} até
                                    {{ date('d/m/Y', strtotime('now')) }}
                                </li>
                            </ul>
                        </form>
                        <h4>
                            <a href="{{ route('announcement.index') }}"
                                class="btn btn-warning btn-flat btn-addon btn-sm mt-2 m-l-5"><i
                                    class="ti-arrow-left"></i>Voltar</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
