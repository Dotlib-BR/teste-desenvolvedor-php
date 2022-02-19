@extends('_template')

@section('content')
    <h1 class="text-center mt-3">Atualizar {{ $table }}</h1>
    <div class="row">
        <div class="col-2 col-md-3"></div>
        <div class="col-8 col-md-6">
            <div class="container">
                <form action='{{ route("{$routePart}.update", [$routePart => $id]) }}' method="post">
                    @csrf
                    @method('PUT')
                    @foreach ($search as $key => $value)
                        @if ($key != 'created_at' && $key != 'updated_at' && $key != 'id' && $key != 'status')
                            <div class="mb-3">
                                <label for="{{ $key }}" class="form-label">{{ ucfirst($key) }}: </label>
                                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}"
                                    value="{{ $value }}">
                            </div>
                        @endif
                        @if ($key == 'status')
                            <div class="mb-3">
                                <label for="{{ $key }}" class="form-label">{{ ucfirst($key) }}: </label>
                                <select  name="{{ $key }}" id="{{ $key }}" class="form-select">
                                    <option value="Em Aberto">Em Aberto</option>
                                    <option value="Pago">Pago</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>

                            </div>
                        @endif
                    @endforeach

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    @if (isset($_GET['success']) && $_GET['success'])
                        <div class="text-center bg-success text-light py-2 rounded">
                            Registro atualizado com sucesso!
                        </div>
                    @endif


                </form>
            </div>
        </div>
        <div class="col-2 col-md-3"></div>
    </div>
@endsection
