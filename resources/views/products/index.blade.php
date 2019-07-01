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

                    <h5 class="card-title">Produtos</h5>
                    <hr>

                    <div class="row mb-2">
                        <div class="col-12 col-md-5 col-lg-4">
                            <form action="{{ route('products.index') }}" method="get">
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
                            <form action="{{ route('products.index') }}" method="get">
                                <div class="row form-group mb-2">
                                    <div class="col-12 col-sm-4 pr-sm-2">
                                        <select class="form-control mr-2 mb-2" name="orderby">
                                            <option value="" hidden {{ ($page['order'][0] == '') ? 'selected' : '' }}>Ordenar por</option>
                                            <option value="name" {{ ($page['order'][0] == 'name') ? 'selected' : '' }}>Nome</option>
                                            <option value="price" {{ ($page['order'][0] == 'price') ? 'selected' : '' }}>Preço</option>
                                            <option value="code" {{ ($page['order'][0] == 'code') ? 'selected' : '' }}>Código de barras</option>
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

                    <form action="{{ route('products.mass-destroy') }}" method="post" id="mass-destroy">
                        @csrf
                        <div class="table-responsive mb-2">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center"><input type="checkbox" id="select-all"></th>
                                        <th scope="col">Nome</th>
                                        <th scope="col" class="text-center">Preço</th>
                                        <th scope="col" class="text-center">Código de barras</th>
                                        <th scope="col" class="text-center">Criado em</th>
                                        <th scope="col" class="text-center">Atualizado em</th>
                                        <th scope="col" class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $product)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="id[]" value="{{ $product->id }}">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td class="text-center">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                            <td class="text-center">{{ $product->code }}</td>
                                            <td class="text-center">{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm mb-1" data-toggle="tooltip" data-title="Ver produto">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm mb-1"  data-toggle="tooltip" data-title="Editar produto">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger btn-sm mb-1 destroy-action"  data-toggle="tooltip" data-title="Excluir produto">
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
                                <button type="submit" class="btn btn-danger btn-block">Excluir produtos</a>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 col-xl-2 mb-2 pl-sm-1">
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-block">Registrar produto</a>
                            </div>
                        </div>
                    </form>

                    <ul class="pagination justify-content-end">
                        <li class="page-item {{ $pagination['current'] == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pagination['current'] == 1 ? '#' : route('products.index') . '?page=1&items=' . $page['items'] }}">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        </li>
                        <li class="page-item {{ $pagination['current'] == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pagination['current'] == 1 ? '#' : route('products.index') . '?page=' . ($pagination['current'] - 1). '&items=' . $page['items'] }}">
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
                                    <a class="page-link" href="{{ route('products.index') . '?page=' . $i . '&items=' . $page['items'] }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        <li class="page-item {{ $pagination['current'] == $pagination['total'] ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pagination['current'] == $pagination['total'] ? '#' : route('products.index') . '?page=' . ($pagination['current'] + 1) . '&items=' . $page['items'] }}">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="page-item {{ $pagination['current'] == $pagination['total'] ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pagination['current'] == $pagination['total'] ? '#' : route('products.index') . '?page=' . $pagination['total'] . '&items=' . $page['items'] }}">
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
                            title: 'Você precisa selecionar os produtos que deseja excluir.'
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
        });
    </script>
@endpush
