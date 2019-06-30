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

            @elseif ($type == 'form')

                <h5 class="card-title">{{ $title }}</h5>
                <hr>
                <form action="{{ route($namespace . '.store') }}" method="post">
                    @csrf
                    <div class="row">
                        @foreach ($fields as $key => $field)
                            <div class="col-12 col-sm-6">
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-{{ $field['icon'] ?? 'question' }}"></i>
                                        </div>
                                    </span>
                                    <input type="{{ $field['type'] ?? 'text' }}" name="{{ $key }}" class="form-control {{ $errors->has($key) ? 'is-invalid' : '' }}" placeholder="{{ $field['label'] ?? '' }}" maxlength="{{ $field['max_length'] ?? 255 }}" value="{{ ($field['type'] ?? 'text') == 'password' ? '' : old($key) }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                    @if ($errors->has($key))
                                        <div class="invalid-feedback">
                                            {{ $errors->first($key) }}
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

            @endif

        </div>
    </div>
</div>
