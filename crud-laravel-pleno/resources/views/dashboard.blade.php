@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Vagas</h5>
                        <p class="card-text">{{ $totalJobs }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Candidatos</h5>
                        <p class="card-text">{{ $totalCandidates }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
