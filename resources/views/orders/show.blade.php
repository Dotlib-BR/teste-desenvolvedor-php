@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title">Informações do Pedido</h5>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-sm-8 col-md-9 col-lg-10">
                            @if ($order->id)
                                <p>
                                    <strong>Número do pedido:</strong><br />
                                    {{ sprintf('%08d', $order->id) }}
                                </p>
                            @endif

                            @php
                                $price = 0;
                            @endphp

                            @if ($order->products->count() > 0)
                                <div class="mb-3">
                                    <strong>Produtos:</strong><br />
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-9 col-lg-7 col-xl-6">
                                            <ul class="list-group mt-0">
                                                @php
                                                    $products = [];

                                                    foreach ($order->products as $product) {
                                                        if (!isset($products[$product->product->name])) {
                                                            $products[$product->product->name] = [
                                                                'amount' => 0,
                                                                'price'  => 0
                                                            ];
                                                        }

                                                        $products[$product->product->name]['amount'] += $product->amount;
                                                        $products[$product->product->name]['price']  += ($product->amount * $product->product->price);
                                                    }
                                                @endphp
                                                @foreach ($products as $name => $product)
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-2 col-sm-2">
                                                                <span class="badge badge-info badge-pill text-white">{{ $product['amount'] }}</span>
                                                            </div>
                                                            <div class="col-10 col-sm-7">
                                                                <span class="ml-2">{{ $name }}</span>
                                                            </div>
                                                            <div class="col-12 col-sm-3 text-center">
                                                                <span class="badge badge-primary badge-pill text-white">R$ {{ number_format($product['price'], 2, ',', '.')  }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($price)
                                <p>
                                    <strong>Preço:</strong><br />
                                    R$ {{ number_format($price, 2, ',', '.') }}
                                </p>
                            @endif

                            @if ($order->discount)
                                <p>
                                    <strong>Desconto:</strong><br />
                                    R$ {{ number_format($order->discount, 2, ',', '.') }}
                                </p>
                            @endif

                            @php
                                $final = $price - $order->discount;

                                if ($final < 0) {
                                    $final = 0;
                                }
                            @endphp

                            @if ($final)
                                <p>
                                    <strong>Valor final:</strong><br />
                                    R$ {{ number_format($final, 2, ',', '.') }}
                                </p>
                            @endif
                        </div>
                        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                            <a href="{{ route('users.show', $order->user_id) }}" class="btn btn-primary btn-block">Ver comprador</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-block">Editar pedido</a>
                            <a href="{{ route('orders.destroy', $order->id) }}" class="btn btn-danger btn-block destroy-action">Excluir pedido</a>
                        </div>
                    </div>

                    <form action="" method="post" id="destroy-single">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            function swalConfirm(callback) {
                window.swal.fire({
                    type: 'warning',
                    title: 'Você tem certeza?',
                    text: 'Você não poderá reverter esta ação.',
                    showCancelButton: true,
                    cancelButtonColor: '#b0b0b0',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#e3342f',
                    confirmButtonText: 'Sim, exclua!'
                }).then(function(result) {
                    if (result.value) {
                        callback();
                    }
                });

                $('body').removeClass('swal2-height-auto');
            }

            $('.destroy-action').on('click', function(e) {
                e.preventDefault();

                var action = $(this).attr('href');

                swalConfirm(function() {
                    $('#destroy-single')
                        .attr('action', action)
                        .submit();
                });
            });
        });
    </script>
@endpush
