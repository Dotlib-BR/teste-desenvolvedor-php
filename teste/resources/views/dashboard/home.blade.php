@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="container-fluid">
        <form method="GET" class="mt-3">
            <div class="form-group row">
                <div class="col-md-3 mt-1 mb-1">
                    <select name="per_page" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option value="20" {{ request()->get('per_page') === null ? 'selected="selected"' : '' }} data-subtext="20 por padrão" data-icon="fa fa-sort">Itens por página</option>

                        @for($i = 5; $i <= $users->total(); $i += 5)
                            <option value="{{ $i }}" {{ $i == request()->get('per_page') && request()->get('per_page') !== null ? 'selected="selected"' : '' }} data-subtext="Itens por página">{{ $i }}</option>
                        @endfor

                    </select>
                </div>
                <div class="col-md-2 mt-1 mb-1">
                    <select name="field_sort" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option value="id" {{ 'id' == request()->get('field_sort') && request()->get('field_sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-filter">Id</option>
                        <option value="name" {{ 'name' == request()->get('field_sort') && request()->get('field_sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-filter">Nome</option>
                        <option value="email" {{ 'email' == request()->get('field_sort') && request()->get('field_sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-filter">Email</option>
                    </select>
                </div>
                <div class="col-md-3 mt-1 mb-1">
                    <select name="sort" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option value="asc" {{ 'asc' == request()->get('sort') && request()->get('sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-sort-alpha-asc" >Ascendente</option>
                        <option value="desc" {{ 'desc' == request()->get('sort') && request()->get('sort') !== null ? 'selected="selected"' : '' }} data-icon="fa fa-sort-alpha-desc" >Descendente</option>
                    </select>
                </div>
                <div class="col-md-4 mt-1 mb-1">
                    <input name="search" class="form-control enterSearch" type="search" value="{{ request()->get('search') }}" placeholder="Enter para buscar" aria-label="Search">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Usuários</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table bg-dotlib table-responsive-sm mt-2">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">*</th>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                {{ $users->appends(request()->input())->links() }}
            </div>
            <div class="col-md-2">
                <p class="font-weight-bold">Total: <span class="text-light">{{ $users->total() }}</span></p>
            </div>
        </div>
    </div>
@endsection
