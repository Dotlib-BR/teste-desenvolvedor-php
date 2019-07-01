@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title">Editar Pedido</h5>
                    <hr>
                    <form id="products" action="{{ route('orders.update', $order->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive mb-2">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">Produto</th>
                                                <th scope="col" class="text-center">Quantidade</th>
                                                <th scope="col" class="text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="row-body">
                                            @php
                                                $all = old('product', null);

                                                if ($all === null) {
                                                    $all = [];

                                                    foreach ($order->products as $product) {
                                                        $all[] = [
                                                            'id'     => $product->product_id,
                                                            'amount' => $product->amount
                                                        ];
                                                    }
                                                }

                                                $last = ($all === null) ? 0 : count($all);
                                            @endphp
                                            @forelse ($all as $row => $current)
                                                <tr id="row-{{ $row }}">
                                                    <td>
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-prepend">
                                                                <div class="input-group-text bg-white">
                                                                    <i class="fas fa-tag }}"></i>
                                                                </div>
                                                            </span>
                                                            <select name="product[{{ $row }}][id]" class="form-control {{ $errors->has('product.' . $row . '.id') ? 'is-invalid' : '' }}">
                                                                @if ($current['id'] === null)
                                                                    <option value="" hidden selected>Selecione</option>
                                                                @endif

                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}" {{ ($product->id == $current['id']) ? 'selected' : '' }}>{{ $product->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('product.' . $row . '.id'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('product.' . $row . '.id') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-prepend">
                                                                <div class="input-group-text bg-white">
                                                                    <i class="fas fa-sort }}"></i>
                                                                </div>
                                                            </span>
                                                            <input type="number" name="product[{{ $row }}][amount]" value="{{ $current['amount'] }}" class="form-control {{ $errors->has('product.' . $row . '.amount') ? 'is-invalid' : '' }}" min="1" />
                                                            @if ($errors->has('product.' . $row . '.amount'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('product.' . $row . '.amount') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="add" class="btn btn-primary btn-sm action">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                        <a href="del" class="btn btn-danger btn-sm action" data-target="{{ $row }}">
                                                            <i class="fas fa-minus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr id="row-0">
                                                    <td class="text-center">
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-prepend">
                                                                <div class="input-group-text bg-white">
                                                                    <i class="fas fa-tag }}"></i>
                                                                </div>
                                                            </span>
                                                            <select name="product[0][id]" class="form-control">
                                                                <option value="" hidden selected>Selecione</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-prepend">
                                                                <div class="input-group-text bg-white">
                                                                    <i class="fas fa-sort }}"></i>
                                                                </div>
                                                            </span>
                                                            <input type="number" name="product[0][amount]" value="1" class="form-control" min="1" />
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="add" class="btn btn-primary btn-sm action">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                        <a href="del" class="btn btn-danger btn-sm action" data-target="0">
                                                            <i class="fas fa-minus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-dollar-sign }}"></i>
                                        </div>
                                    </span>
                                    <input type="number" name="discount" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" placeholder="Desconto" step="0.01" value="{{ old('discount', $order->discount) }}" min="0" required>
                                    @if ($errors->has('discount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('discount') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-bookmark }}"></i>
                                        </div>
                                    </span>
                                    <select name="status" class="form-control">
                                        <option value="open" {{ ($order->status == 'open') ? 'selected' : '' }}>Em aberto</option>
                                        <option value="paid" {{ ($order->status == 'paid') ? 'selected' : '' }}>Pago</option>
                                        <option value="canceled" {{ ($order->status == 'canceled') ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-xl-2 offset-sm-3 offset-md-4 offset-xl-5 text-center mt-2">
                                <button type="submit" class="btn btn-primary btn-block">Editar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('row')
    <tr>
        <td class="text-center">
            <div class="input-group mb-2">
                <span class="input-group-prepend">
                    <div class="input-group-text bg-white">
                        <i class="fas fa-tag }}"></i>
                    </div>
                </span>
                <select name="" class="form-control">
                    <option value="" hidden selected>Selecione</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </td>
        <td class="text-center">
            <div class="input-group mb-2">
                <span class="input-group-prepend">
                    <div class="input-group-text bg-white">
                        <i class="fas fa-sort }}"></i>
                    </div>
                </span>
                <input type="number" name="" value="1" class="form-control" min="1" />
            </div>
        </td>
        <td class="text-center">
            <a href="add" class="btn btn-primary btn-sm action">
                <i class="fas fa-plus"></i>
            </a>
            <a href="del" class="btn btn-danger btn-sm action">
                <i class="fas fa-minus"></i>
            </a>
        </td>
    </tr>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var last = {{ $last }};
            var row  = $($.parseHTML(`@yield('row')`));

            $('#products').on('click', '.action', function(e) {
                e.preventDefault();

                var action = $(this).attr('href');

                if (action == 'del') {
                    var target = $(this).data('target');
                    $('#row-' + target).remove();

                    if ($('#row-body').children().length == 0) {
                        last = 0;

                        var newRow = row.clone()
                                        .attr('id', 'row-' + last);

                        newRow.find('a[href="del"]')
                              .attr('data-target', last);

                        newRow.find('select')
                              .attr('name', 'product['+ last +'][id]');

                        newRow.find('input')
                              .attr('name', 'product['+ last +'][amount]');

                        $('#row-body').append(newRow);

                        last++;
                    }
                } else {
                    var newRow = row.clone()
                                    .attr('id', 'row-' + last);

                    newRow.find('a[href="del"]')
                          .attr('data-target', last);

                    newRow.find('select')
                          .attr('name', 'product['+ last +'][id]');

                    newRow.find('input')
                          .attr('name', 'product['+ last +'][amount]');

                    $('#row-body').append(newRow);

                    last++;
                }
            });
        });
    </script>
@endpush
