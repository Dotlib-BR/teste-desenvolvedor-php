@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            </div>
        </div>

        <form method="GET">
            <div class="form-group row">
                <div class="col-md-3">
                    <select name="per_page" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option value="{{ $pages->total }}" {{ $pages->total == request()->get('per_page') && request()->get('per_page') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-sort">Itens por página</option>

                        @for($i = 5; $i <= $pages->total; $i += 5)
                            <option value="{{ $i }}" {{ $i == request()->get('per_page') && request()->get('per_page') !== null ? 'selected="selected"' : '' }} data-subtext="Itens por página">{{ $i }}</option>
                        @endfor

                    </select>
                </div>
                <div class="col-md-2">
                    <select name="field_sort" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option value="id" {{ 'id' == request()->get('field_sort') && request()->get('field_sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-filter">Id</option>
                        <option value="name" {{ 'name' == request()->get('field_sort') && request()->get('field_sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-filter">Nome</option>
                        <option value="email" {{ 'email' == request()->get('field_sort') && request()->get('field_sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-filter">Email</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option value="asc" {{ 'asc' == request()->get('sort') && request()->get('sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-sort-alpha-asc" >Ascendente</option>
                        <option value="desc" {{ 'desc' == request()->get('sort') && request()->get('sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-sort-alpha-desc" >Descendente</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input name="search" class="form-control" id="enterSearch" type="search" value="{{ request()->get('search') }}" placeholder="Buscar" aria-label="Search">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <table class="table bg-dotlib table-responsive-sm mt-2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($clients as $client)
                        <tr>
                            <th scope="row">{{ $client->id }}</th>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">*</th>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p class="font-weight-bold">Total: <span class="text-light">{{ $pages->total }}</span></p>
            </div>
            <div class="col-md-10">
                @paginate(['pages' => $pages, 'params' => $params])
                @endpaginate
            </div>
        </div>
    </div>
@endsection
