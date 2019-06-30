@php
    $orderby = request()->input('orderby');
    $order   = request()->input('order');
    $search  = request()->input('search');
    $items   = request()->input('items');
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
