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
            ]
        ])
    </div>
@endsection
