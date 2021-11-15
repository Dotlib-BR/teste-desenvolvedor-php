@extends('template.template-login')
@section('conteudo')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Cadastro</div>
                    <div class="card-body">
                        @include('users.form',['action'=>'/auth/store'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

