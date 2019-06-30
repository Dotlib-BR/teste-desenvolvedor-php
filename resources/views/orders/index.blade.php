@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @php
                        $page = [
                            'search' => request()->get('search') ?? '',
                            'order'  => [ request()->get('orderby') ?? '', request()->get('order') ?? '' ],
                            'items'  => request()->get('items') ?? 20
                        ];
                    @endphp

                    <h5 class="card-title">Pedidos</h5>
                    <hr>

                    <div class="row mb-2">
                        <div class="col-12 col-md-5 col-lg-4">
                            <form action="{{ route('orders.index') }}" method="get">
                                <div class="row form-group mb-2">
                                    <div class="col-12 col-sm-9 pr-sm-2">
                                        <input type="search" name="search" id="search" class="form-control mr-2 mb-2" value="{{ $page['search'] }}" placeholder="Filtrar por">
                                    </div>
                                    <div class="col-12 col-sm-3 pl-sm-0">
                                        <button type="submit" class="btn btn-secondary btn-block mb-2">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-6 col-lg-5 offset-md-1 offset-lg-3">
                            <form action="{{ route('orders.index') }}" method="get">
                                <div class="row form-group mb-2">
                                    <div class="col-12 col-sm-4 pr-sm-2">
                                        <select class="form-control mr-2 mb-2" name="orderby">
                                            <option value="" hidden {{ ($page['order'][0] == '') ? 'selected' : '' }}>Ordenar por</option>
                                            <option value="id" {{ ($page['order'][0] == 'id') ? 'selected' : '' }}>Número do pedido</option>
                                            <option value="discount" {{ ($page['order'][0] == 'discount') ? 'selected' : '' }}>Desconto</option>
                                            <option value="status" {{ ($page['order'][0] == 'status') ? 'selected' : '' }}>Status</option>
                                            <option value="created_at" {{ ($page['order'][0] == 'created_at') ? 'selected' : '' }}>Criado em</option>
                                            <option value="updated_at" {{ ($page['order'][0] == 'updated_at') ? 'selected' : '' }}>Atualizado em</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3 pr-sm-2 pl-sm-0">
                                        <select class="form-control mr-2 mb-2" name="order">
                                            <option value="" hidden {{ ($page['order'][1]) ? 'selected' : '' }}>Ordem</option>
                                            <option value="asc" {{ ($page['order'][1]) ? 'selected' : '' }}>Crescente</option>
                                            <option value="desc" {{ ($page['order'][1]) ? 'selected' : '' }}>Decrescente</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-2 pr-sm-2 pl-sm-0">
                                        <select class="form-control mr-2 mb-2" name="items">
                                            @php
                                                $options = [5, 10, 20, 30, 50, 100, 250, 500];
                                            @endphp
                                            @foreach ($options as $option)
                                                <option value="{{ $option }}" {{ ($page['items'] == $option) ? 'selected' : '' }}>{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-3 pl-sm-0 col-">
                                        <button type="submit" class="btn btn-secondary btn-block mb-2">Ordenar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

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
                                    @foreach ($items as $order)
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

                        <div class="row mb-2 justify-content-end">
                            <div class="col-12 col-sm-4 col-md-3 col-xl-2 mb-2 pr-sm-1">
                                <button type="submit" class="btn btn-danger btn-block">Excluir pedidos</a>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-xl-2 mb-2 pl-sm-1">
                                <a href="{{ route('orders.create') }}" class="btn btn-primary btn-block">Registrar pedido</a>
                            </div>
                        </div>
                    </form>

                    <ul class="pagination justify-content-end">
                        <li class="page-item {{ $pagination['current'] == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pagination['current'] == 1 ? '#' : route('orders.index') . '?page=1&items=' . $page['items'] }}">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        </li>
                        <li class="page-item {{ $pagination['current'] == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pagination['current'] == 1 ? '#' : route('orders.index') . '?page=' . ($pagination['current'] - 1). '&items=' . $page['items'] }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>

                        @php
                            $start = $pagination['current'] - 2;
                            $end   = $pagination['current'] + 2;

                            if ($start < 1) {
                                $start = 1;
                            }

                            if ($end > $pagination['total']) {
                                $end = $pagination['total'];
                            }
                        @endphp

                        @for ($i = $start; $i <= $end; ++$i)
                            @if ($i == $pagination['current'])
                                <li class="page-item active">
                                    <span class="page-link">{{ $i }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ route('orders.index') . '?page=' . $i . '&items=' . $page['items'] }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        <li class="page-item {{ $pagination['current'] == $pagination['total'] ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pagination['current'] == $pagination['total'] ? '#' : route('orders.index') . '?page=' . ($pagination['current'] + 1) . '&items=' . $page['items'] }}">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="page-item {{ $pagination['current'] == $pagination['total'] ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pagination['current'] == $pagination['total'] ? '#' : route('orders.index') . '?page=' . $pagination['total'] . '&items=' . $page['items'] }}">
                                <i class="fas fa-angle-double-right"></i>
                            </a>
                        </li>
                    </ul>

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
        });
    </script>
@endpush
