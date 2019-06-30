<div class="card">
    <div class="card-content">
        <div class="card-body">

            @if ($type == 'statistic')

                <div class="media d-flex">
                    <div class="align-self-center">
                        <i class="fas fa-{{ $icon }} fa-3x"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3>{{ $total }}</h3>
                        <span>{{ $title }}</span>
                    </div>
                </div>

            @elseif ($type == 'content')

                <h5 class="card-title">{{ $title }}</h5>
                <hr>

                @php
                    $orderby = request()->get('orderby');
                    $order   = request()->get('order');
                    $search  = request()->get('search');
                    $items   = request()->get('items');
                @endphp

                <div class="row mb-2">
                    <div class="col-12 col-md-5 col-lg-4">
                        <form action="{{ request()->url() }}" method="get">
                            <div class="row form-group mb-2">
                                <div class="col-12 col-sm-9 pr-sm-2">
                                    <input type="search" name="search" id="search" class="form-control mr-2 mb-2" value="{{ $search }}" placeholder="Filtrar por">
                                </div>
                                <div class="col-12 col-sm-3 pl-sm-0">
                                    <button type="submit" class="btn btn-secondary btn-block mb-2">Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5 offset-md-1 offset-lg-3">
                        <form action="{{ request()->url() }}" method="get">
                            <div class="row form-group mb-2">
                                <div class="col-12 col-sm-4 pr-sm-2">
                                    <select class="form-control mr-2 mb-2" name="orderby">
                                        <option value="" hidden {{ empty($orderby) ? 'selected' : '' }}>Ordenar por</option>
                                        @foreach ($columns as $key => $column)
                                            <option value="{{ $key }}" {{ $orderby == $key ? 'selected' : '' }}>{{ $column }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3 pr-sm-2 pl-sm-0">
                                    <select class="form-control mr-2 mb-2" name="order">
                                        <option value="" hidden {{ empty($order) ? 'selected' : '' }}>Ordem</option>
                                        <option value="asc" {{ $order == 'asc' ? 'selected' : '' }}>Crescente</option>
                                        <option value="desc" {{ $order == 'desc' ? 'selected' : '' }}>Decrescente</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-2 pr-sm-2 pl-sm-0">
                                    <input type="text" name="items" value="{{ $items }}" class="form-control" placeholder="Itens">
                                </div>
                                <div class="col-12 col-sm-3 pl-sm-0 col-">
                                    <button type="submit" class="btn btn-secondary btn-block mb-2">Ordenar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <form action="{{ route($route . '.mass-destroy') }}" method="post" id="mass-destroy">
                    @csrf
                    <div class="table-responsive mb-2">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    @foreach ($columns as $column => $name)
                                        <th scope="col" class="{{ $column == 'name' ? '' : 'text-center' }}">{{ $name }}</th>
                                    @endforeach
                                    <th scope="col" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($values as $array)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name="id[]" value="{{ $array['id'] }}"></td>
                                        @foreach ($array as $column => $value)
                                            @switch ($column)
                                                @case ('id')
                                                    @break
                                                @case ('price')
                                                    <td class="text-center">R$ {{ number_format((int)$value, 2, ',', '.') }}</td>
                                                    @break
                                                @default
                                                    <td class="{{ $column == 'name' ? '' : 'text-center' }}">{{ $value }}</td>
                                                    @break
                                            @endswitch
                                        @endforeach
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route($route . '.show', $array['id']) }}" class="btn btn-primary btn-sm mb-1" data-toggle="tooltip" data-title="Ver {{ $namespace }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route($route . '.edit', $array['id']) }}" class="btn btn-primary btn-sm mb-1"  data-toggle="tooltip" data-title="Editar {{ $namespace }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route($route . '.destroy', $array['id']) }}" class="btn btn-danger btn-sm mb-1 destroy-action"  data-toggle="tooltip" data-title="Excluir {{ $namespace }}">
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
                            <button type="submit" class="btn btn-danger btn-block">Excluir selecionados</a>
                        </div>
                        <div class="col-12 col-sm-4 col-md-3 col-xl-2 mb-2 pl-sm-1">
                            <a href="{{ route($route . '.create') }}" class="btn btn-primary btn-block">Registrar {{ mb_strtolower($namespace) }}</a>
                        </div>
                    </div>
                </form>

                <ul class="pagination justify-content-end">
                    <li class="page-item {{ $pagination['current'] == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $pagination['current'] == 1 ? '#' : request()->url() . '?page=1&items=' . $items }}">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                    </li>
                    <li class="page-item {{ $pagination['current'] == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $pagination['current'] == 1 ? '#' : request()->url() . '?page=' . ($pagination['current'] - 1). '&items=' . $items }}">
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
                                <a class="page-link" href="{{ request()->url() . '?page=' . $i . '&items=' . $items }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor

                    <li class="page-item {{ $pagination['current'] == $pagination['total'] ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $pagination['current'] == $pagination['total'] ? '#' : request()->url() . '?page=' . ($pagination['current'] + 1) . '&items=' . $items }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item {{ $pagination['current'] == $pagination['total'] ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $pagination['current'] == $pagination['total'] ? '#' : request()->url() . '?page=' . $pagination['total'] . '&items=' . $items }}">
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </li>
                </ul>

                <form action="" method="post" id="destroy-single">
                    @csrf
                    @method('DELETE')
                </form>

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

                                    var form = $(this);

                                    swalConfirm(function() {
                                        massSubmit = true;
                                        form.submit();
                                    });
                                }

                                massSubmit = false;
                            });
                        });
                    </script>
                @endpush

            @elseif ($type == 'create')

                <h5 class="card-title">{{ $title }}</h5>
                <hr>
                <form action="{{ route($route . '.store') }}" method="post">
                    @csrf
                    <div class="row">
                        @foreach ($fields as $column => $field)
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-{{ $field['icon'] ?? 'question' }}"></i>
                                        </div>
                                    </span>
                                    <input type="{{ $field['type'] ?? 'text' }}" name="{{ $column }}" class="form-control {{ $errors->has($column) ? 'is-invalid' : '' }}" placeholder="{{ $field['label'] ?? '' }}" maxlength="{{ $field['max_length'] ?? 255 }}" value="{{ ($field['type'] ?? 'text') == 'password' ? '' : old($column) }}" {{ $field['type'] == 'number' ? 'step=0.01' : ''}} {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                    @if ($errors->has($column))
                                        <div class="invalid-feedback">
                                            {{ $errors->first($column) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 col-sm-6 col-md-4 col-xl-2 offset-sm-3 offset-md-4 offset-xl-5 text-center mt-2">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                    </div>
                </form>

            @elseif ($type == 'show')

                <h5 class="card-title">{{ $title }}</h5>
                <hr>
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-9 col-lg-10">
                        @foreach ($columns as $column => $name)
                            @if (!empty($model->$column))
                                <p>
                                    <strong>{{ $name }}:</strong><br />
                                    {{ $model->$column }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                        <a href="{{ route($route . '.edit', $model->id) }}" class="btn btn-primary btn-block">Editar {{ mb_strtolower($namespace) }}</a>
                        <a href="{{ route($route . '.destroy', $model->id) }}" class="btn btn-danger btn-block destroy-action">Excluir {{ mb_strtolower($namespace) }}</a>
                    </div>
                </div>

                <form action="" method="post" id="destroy-single">
                    @csrf
                    @method('DELETE')
                </form>

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

            @elseif ($type == 'edit')

                <h5 class="card-title">{{ $title }}</h5>
                <hr>
                <form action="{{ route($route . '.update', $model->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach ($fields as $column => $field)
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-{{ $field['icon'] ?? 'question' }}"></i>
                                        </div>
                                    </span>
                                    <input type="{{ $field['type'] ?? 'text' }}" name="{{ $column }}" class="form-control {{ $errors->has($column) ? 'is-invalid' : '' }}" placeholder="{{ $field['label'] ?? '' }}" maxlength="{{ $field['max_length'] ?? 255 }}" value="{{ ($field['type'] ?? 'text') == 'password' ? '' : old($column, $model->$column) }}" {{ $field['type'] == 'number' ? 'step=0.01' : ''}} {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                    @if ($errors->has($column))
                                        <div class="invalid-feedback">
                                            {{ $errors->first($column) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 col-sm-6 col-md-4 col-xl-2 offset-sm-3 offset-md-4 offset-xl-5 text-center mt-2">
                            <button type="submit" class="btn btn-primary btn-block">Editar</button>
                        </div>
                    </div>
                </form>

            @endif

        </div>
    </div>
</div>
