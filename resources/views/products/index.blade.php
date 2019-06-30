@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('partials.page', [
            'type'       => 'content',
            'title'      => 'Produtos',
            'columns'    => [
                'name'       => 'Nome',
                'price'      => 'Preço',
                'code'       => 'Código de barras',
                'created_at' => 'Criado em',
                'updated_at' => 'Atualizado em'
            ]
        ])
    </div>
@endsection
