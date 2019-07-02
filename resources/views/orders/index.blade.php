@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('orders.mass-destroy') }}" method="post" id="mass-destroy">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-8">
                                <h5 class="card-title">Pedidos</h5>
                            </div>
                            <div class="col-6 col-sm-3 col-md-2">
                                <button type="submit" class="btn btn-danger btn-block btn-sm">Excluir</a>
                            </div>
                            <div class="col-6 col-sm-3 col-md-2">
                                <a href="{{ route('orders.create') }}" class="btn btn-primary btn-block btn-sm">Registrar</a>
                            </div>
                        </div>
                        <hr class="mt-1 mb-4">
                        <table class="table table-striped table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center"><input type="checkbox" id="select-all"></th>
                                    <th scope="col" class="text-center">Número do pedido</th>
                                    <th scope="col" class="text-center">Produtos</th>
                                    <th scope="col" class="text-center">Valor</th>
                                    <th scope="col" class="text-center">Desconto</th>
                                    <th scope="col" class="text-center">Valor final</th>
                                    <th scope="col" class="text-center">Comprador</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Criado em</th>
                                    <th scope="col" class="text-center">Atualizado em</th>
                                    <th scope="col" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        $products = [];
                                        $price    = 0;

                                        foreach ($order->products as $product) {
                                            if (!isset($products[$product->product->name])) {
                                                $products[$product->product->name] = 0;
                                            }

                                            $price                             += $product->product->price * $product->amount;
                                            $products[$product->product->name] += $product->amount;
                                        }

                                        $products = implode(', ', array_map(function($amount, $name) use(&$count) {
                                            return sprintf('%02d %s', $amount, $name);
                                        }, $products, array_keys($products)));

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
                                        <td class="text-center">{{ $order->user->name }}</td>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post" id="destroy-single">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

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

            $('#select-all').on('click', function(e) {
                var checked = this.checked;

                $('input[type="checkbox"]').each(function() {
                    this.checked = checked;
                });
            });

            $('input[type="checkbox"]').on('click', function() {
                var checked = $('input[id!="select-all"][type="checkbox"]:checked').length;
                var total   = $('input[id!="select-all"][type="checkbox"]').length;

                if (checked == total) {
                    $('#select-all').prop('checked', true);
                } else {
                    $('#select-all').prop('checked', false);
                }
            });

            DataTable([0, 10], 1);
        });
    </script>
@endpush
