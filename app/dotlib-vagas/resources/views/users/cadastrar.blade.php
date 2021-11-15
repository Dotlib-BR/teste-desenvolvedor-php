@extends('template.template') @section('conteudo')
    <div class="container-md conteudo">
            <h3 class="modal-title pt-3">
                @if(isset($user)) Editar @else Cadastrar novo @endif usuário
            </h3>
            @if(Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif

        @include('users.form',['action'=>'/users'])
    </div>
@endsection
