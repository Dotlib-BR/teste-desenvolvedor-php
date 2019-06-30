@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('partials.page', [
            'type'   => 'edit',
            'title'  => 'Editar Produto',
            'fields' => [
                'name'      => [
                    'type'       => 'text',
                    'label'      => 'Nome',
                    'icon'       => 'tag',
                    'max_length' => 100,
                    'required'   => true
                ],
                'price'     => [
                    'type'       => 'number',
                    'label'      => 'Preço',
                    'icon'       => 'dollar-sign',
                    'required'   => true
                ],
                'code'      => [
                    'type'       => 'text',
                    'label'      => 'Código de barras',
                    'icon'       => 'barcode',
                    'max_length' => 20,
                    'required'   => true
                ]
            ]
        ])
    </div>
@endsection
