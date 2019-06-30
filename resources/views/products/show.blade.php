@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('partials.page', [
            'type'    => 'show',
            'title'   => 'Informações do Produto',
            'columns' => [
                'name'  => 'Nome',
                'price' => 'Preço',
                'code'  => 'Código de barras'
            ]
        ])
    </div>
@endsection
