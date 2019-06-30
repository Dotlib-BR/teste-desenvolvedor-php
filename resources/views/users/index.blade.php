@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('components.card', [
            'type'       => 'content',
            'title'      => 'Usuários',
            'columns'    => [
                'name'       => 'Nome',
                'email'      => 'E-mail',
                'document'   => 'CPF',
                'created_at' => 'Criado em',
                'updated_at' => 'Atualizado em'
            ],
            'button'     => 'Registrar usuário'
        ])
    </div>
@endsection
