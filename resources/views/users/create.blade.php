@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('components.card', [
            'type'   => 'form',
            'title'  => 'Registrar usuário',
            'fields' => [
                'name'      => [
                    'type'       => 'text',
                    'label'      => 'Nome',
                    'icon'       => 'user',
                    'max_length' => 100,
                    'required'   => true
                ],
                'email'     => [
                    'type'       => 'email',
                    'label'      => 'E-mail',
                    'icon'       => 'envelope',
                    'required'   => true
                ],
                'password'  => [
                    'type'       => 'password',
                    'label'      => 'Senha',
                    'icon'       => 'lock',
                    'required'   => true
                ],
                'document'  => [
                    'type'       => 'text',
                    'label'      => 'CPF',
                    'icon'       => 'id-card',
                    'max_length' => 11,
                    'required'   => true
                ]
            ]
        ])
    </div>
@endsection
