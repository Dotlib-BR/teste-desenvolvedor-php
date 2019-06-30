@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title">Informações do Usuário</h5>
                    <hr>
                    <div class="row mb-5">
                        <div class="col-12 col-sm-8 col-md-9 col-lg-10">
                            @if ($user->name)
                                <p>
                                    <strong>Nome:</strong><br />
                                    {{ $user->name }}
                                </p>
                            @endif

                            @if ($user->email)
                            <p>
                                <strong>E-mail:</strong><br />
                                {{ $user->email }}
                            </p>
                            @endif

                            @if ($user->document)
                            <p>
                                <strong>CPF:</strong><br />
                                {{ $user->document }}
                            </p>
                            @endif
                        </div>
                        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-block">Editar usuário</a>
                            <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-block destroy-action">Excluir usuário</a>
                        </div>
                    </div>

                    <form action="" method="post" id="destroy-single">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title">Últimos Pedidos do Usuário</h5>
                    <hr>
                    <form action="{{ route('orders.mass-destroy') }}" method="post" id="mass-destroy">
                        @csrf
                        <div class="table-responsive mb-2">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Número do pedido</th>
                                        <th scope="col" class="text-center">Produtos</th>
                                        <th scope="col" class="text-center">Valor</th>
                                        <th scope="col" class="text-center">Desconto</th>
                                        <th scope="col" class="text-center">Valor final</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Criado em</th>
                                        <th scope="col" class="text-center">Atualizado em</th>
                                        <th scope="col" class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $orders = $user->orders()->latest()->take(15)->get();
                                    @endphp

                                    @foreach ($orders as $order)
                                        @php
                                            $products = $order->products->pluck('product.name', 'amount')->toArray();
                                            $products = implode(', ', array_map(function($value, $key) use(&$count) {
                                                return sprintf('%02d %s', $key, $value);
                                            }, $products, array_keys($products)));

                                            $price    = $order->products->sum('product.price');
                                            $final    = $price - $order->discount;

                                            if ($final < 0) {
                                                $final = 0;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="id[]" value="{{ $order->id }}">
                                            </td>
                                            <td class="text-center">{{ sprintf('%08d', $order->id) }}</td>
                                            <td class="text-center">
                                                {!! $products !!}
                                            </td>
                                            <td class="text-center">R$ {{ number_format($price, 2, ',', '.') }}</td>
                                            <td class="text-center">R$ {{ number_format($order->discount, 2, ',', '.') }}</td>
                                            <td class="text-center">R$ {{ number_format($final, 2, ',', '.') }}</td>
                                            <td class="text-center">
                                                @switch ($order->status)
                                                    @case ('open')
                                                        <span class="badge badge-info">Em aberto</span>
                                                    @break

                                                    @case ('paid')
                                                        <span class="badge badge-success">Pago</span>
                                                    @break

                                                    @case ('canceled')
                                                        <span class="badge badge-danger">Cancelado</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">{{ $order->updated_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm mb-1" data-toggle="tooltip" data-title="Ver pedido">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm mb-1"  data-toggle="tooltip" data-title="Editar pedido">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('orders.destroy', $order->id) }}" class="btn btn-danger btn-sm mb-1 destroy-action"  data-toggle="tooltip" data-title="Excluir pedido">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

            var massSubmit = false;

            $('#mass-destroy').on('submit', function(e) {
                if (!massSubmit) {
                    e.preventDefault();

                    if ($(this).parent().find('input').is(':checked')) {
                        var form = $(this);

                        swalConfirm(function() {
                            massSubmit = true;
                            form.submit();
                        });
                    } else {
                        window.toast.fire({
                            type: 'error',
                            title: 'Você precisa selecionar os pedidos que deseja excluir.'
                        });
                    }
                }

                massSubmit = false;
            });
        });
    </script>
@endpush
