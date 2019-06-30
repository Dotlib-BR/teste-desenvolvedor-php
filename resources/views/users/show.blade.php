@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('partials.page', [
            'type'    => 'show',
            'title'   => 'Informações do Usuário',
            'columns' => [
                'name'      => 'Nome',
                'email'     => 'E-mail',
                'document'  => 'CPF'
            ],
            'actions' => [
                route($route . '.edit', $model->id)     => [
                    'label' => 'Atualizar usuário',
                    'type'  => 'get'
                ],
                route($route . '.destroy', $model->id)  => [
                    'label' => 'Excluir usuário',
                    'type'  => 'delete'
                ]
            ]
        ])
    </div>
@endsection
