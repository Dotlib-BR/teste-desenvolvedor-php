@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('components.card', [
            'type'    => 'show',
            'title'   => 'Informações do Produto',
            'columns' => [
                'name'  => 'Nome',
                'price' => 'Preço',
                'code'  => 'Código de barras'
            ],
            'actions' => [
                route($namespace . '.edit', $model->id)     => [
                    'label' => 'Atualizar produto',
                    'type'  => 'get'
                ],
                route($namespace . '.destroy', $model->id)  => [
                    'label' => 'Excluir produto',
                    'type'  => 'delete'
                ]
            ]
        ])
    </div>
@endsection
