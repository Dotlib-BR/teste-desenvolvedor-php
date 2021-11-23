@extends('layouts.dashboard')

@section('title', $title )

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Total de Usuários Cadastrados (Ativos)</div>
                    <div class="stat-digit">{{ $usersTotal }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-layout-tab color-success border-success"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Total de Empresas Cadastradas</div>
                    <div class="stat-digit">{{ $companiesTotal }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-text">Total de Anúcios  Cadastrados</div>
                    <div class="stat-digit">{{ $announcementsTotal }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
