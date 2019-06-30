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
            ],
            'actions' => [
                route($route . '.edit', $model->id)     => [
                    'label' => 'Atualizar produto',
                    'type'  => 'get'
                ],
                route($route . '.destroy', $model->id)  => [
                    'label' => 'Excluir produto',
                    'type'  => 'delete'
                ]
            ]
        ])
    </div>
@endsection
