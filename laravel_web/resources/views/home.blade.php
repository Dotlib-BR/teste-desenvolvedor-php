@extends('layouts.app')

@section('template_title', 'Dashboard')

@section('content')

    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Dashboard</h2>
        </div>

        <div class="card-body p-5">
            <h3 class="text-center">Módulos</h3>

            <div class="row d-flex flex-row align-content-center">
                <div class="col-12 col-md-4">
                    <div class="card border-dark my-4 mx-5">
                        <div class="card-header fs-3 p-1 text-center">Clientes</div>
                        <div class="card-body text-dark d-flex justify-content-center align-items-center gap-5">
                            <h5 class="card-title"><i class="fas fa-users fa-2x"></i></h5>
                            <div>
                                <h3 class="card-text text-success">{{count($clientes_ativos)}} Ativos</h3>
                                <h3 class="card-text text-danger">{{count($clientes_inativos)}} Inativos</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-dark my-4 mx-5">
                        <div class="card-header fs-3 p-1 text-center">Pedidos</div>
                        <div class="card-body text-dark d-flex justify-content-center align-items-center gap-5">
                            <h5 class="card-title"><i class="fab fa-shopify fa-2x"></i></h5>
                            <div>
                                <h3 class="card-text text-success">{{count($pedidos_pagos)}} Pagos</h3>
                                <h3 class="card-text text-secondary">{{count($pedidos_abertos)}} Em Aberto</h3>
                                <h3 class="card-text text-danger">{{count($pedidos_cancelados)}} Cancelados</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-dark my-4 mx-5">
                        <div class="card-header fs-3 p-1 text-center">Produtos</div>
                        <div class="card-body text-dark d-flex justify-content-center align-items-center gap-5">
                            <h5 class="card-title"><i class="fas fa-truck-loading fa-2x"></i></h5>
                            <div>
                                <h3 class="card-text text-success">{{count($produtos_ativos)}} Ativos</h3>
                                <h3 class="card-text text-danger">{{count($produtos_inativos)}} Inativos</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
