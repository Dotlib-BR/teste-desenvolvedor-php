@extends('layouts.main')

@section ('content')
<section class="container-sm w-100 h-100 d-flex mt-5 flex-column">
    <header class="d-flex flex-column align-items-center">
        <i class="bi bi-house-fill" style="font-size: 6rem"></i>

        <h1>Desafio dev Júnior DotLib</h1>
    </header>
    <main class="w-100 d-flex justify-content-between align-items-center">
        <div class="card text-white bg-primary col-4 m-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h2>Pedidos</h2>
                        <h4>{{ $orders_count }}</h4>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-cart-check-fill" style="font-size: 3.5rem"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('orders') }}" class="text-white d-flex justify-content-between align-items-center">
                    <div class="float-left">Ver mais</div>
                    <div class="float-right"><i class="bi bi-chevron-right"></i></div>
                </a>
            </div>
        </div>

        <div class="card text-white bg-success col-4 m-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h2>Produtos</h2>
                        <h4>{{ $products_count }}</h4>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-box2-fill" style="font-size: 3.5rem"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('products') }}" class="text-white d-flex justify-content-between align-items-center">
                    <div class="float-left">Ver mais</div>
                    <div class="float-right"><i class="bi bi-chevron-right"></i></div>
                </a>
            </div>
        </div>

        <div class="card text-white bg-danger col-4 m-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h2>Clientes</h2>
                        <h4>{{ $customers_count }}</h4>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-person-fill" style="font-size: 3.5rem"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('customers') }}" class="text-white d-flex justify-content-between align-items-center">
                    <div class="float-left">Ver mais</div>
                    <div class="float-right"><i class="bi bi-chevron-right"></i></div>
                </a>
            </div>
        </div>
    </main>
</section>
@endsection
