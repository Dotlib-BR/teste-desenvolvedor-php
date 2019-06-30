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

                <div class="row">
                    <div class="col-12 col-sm-8 col-md-9 col-xl-10">
                        <h5 class="card-title">{{ $title }}</h5>
                    </div>
                    <div class="col-12 col-sm-4 col-md-3 col-xl-2">
                        <a href="{{ route($namespace . '.create') }}" class="btn btn-primary btn-block">{{ $button }}</a>
                    </div>
                </div>

                <hr>

                @include('components.filter', [
                    'columns' => $columns
                ])

                @include('components.table', [
                    'columns'   => $columns,
                    'values'    => $values,
                ])

                @include('components.pagination', [
                    'pagination' => $pagination
                ])

            @elseif ($type == 'create')

                <h5 class="card-title">{{ $title }}</h5>
                <hr>
                <form action="{{ route($namespace . '.store') }}" method="post">
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
                                    <input type="{{ $field['type'] ?? 'text' }}" name="{{ $column }}" class="form-control {{ $errors->has($column) ? 'is-invalid' : '' }}" placeholder="{{ $field['label'] ?? '' }}" maxlength="{{ $field['max_length'] ?? 255 }}" value="{{ ($field['type'] ?? 'text') == 'password' ? '' : old($column) }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
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
                        @foreach ($actions as $action => $data)
                            <form action="{{ $action }}" method="{{ $data['type'] == 'get' ? 'get' : 'post' }}" class="mb-2 {{ $data['type'] == 'delete' ? 'form-delete' : '' }}">
                                @if ($data['type'] != 'get')
                                    @csrf

                                    @if ($data['type'] != 'post')
                                        @method(strtoupper($data['type']))
                                    @endif
                                @endif

                                <button type="submit" class="btn btn-{{ $data['type'] == 'delete' ? 'danger' : 'primary' }} btn-block">{{ $data['label'] }}</button>
                            </form>
                        @endforeach
                    </div>
                </div>

                @push('script')
                    <script type="text/javascript">
                        $(document).ready(function() {
                            var submit = false;

                            $('.form-delete').on('submit', function(e) {
                                if (!submit) {
                                    e.preventDefault();

                                    var form = $(this);

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
                                            submit = true;
                                            form.submit();
                                        }
                                    });

                                    $('body').removeClass('swal2-height-auto');
                                }

                                submit = false;
                            });
                        });
                    </script>
                @endpush

            @elseif ($type == 'edit')

                <h5 class="card-title">{{ $title }}</h5>
                <hr>
                <form action="{{ route($namespace . '.update', $model->id) }}" method="post">
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
                                    <input type="{{ $field['type'] ?? 'text' }}" name="{{ $column }}" class="form-control {{ $errors->has($column) ? 'is-invalid' : '' }}" placeholder="{{ $field['label'] ?? '' }}" maxlength="{{ $field['max_length'] ?? 255 }}" value="{{ ($field['type'] ?? 'text') == 'password' ? '' : old($column, $model->$column) }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                    @if ($errors->has($column))
                                        <div class="invalid-feedback">
                                            {{ $errors->first($column) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 col-sm-6 col-md-4 col-xl-2 offset-sm-3 offset-md-4 offset-xl-5 text-center mt-2">
                            <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
                        </div>
                    </div>
                </form>

            @endif

        </div>
    </div>
</div>
