@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('components.card', [
            'type'    => 'show',
            'title'   => 'Informações de Usuário',
            'columns' => [
                'name'      => 'Nome',
                'email'     => 'E-mail',
                'document'  => 'CPF'
            ],
            'actions' => [
                route($namespace . '.edit', $model->id)     => [
                    'label' => 'Atualizar usuário',
                    'type'  => 'get'
                ],
                route($namespace . '.destroy', $model->id)  => [
                    'label' => 'Excluir usuário',
                    'type'  => 'delete'
                ]
            ]
        ])
    </div>
@endsection
