@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-lg-10">
            <div class="card shadow-lg border-0 py-2">
                <div class="card-body text-center pb-0 mt-0 pt-3">
                    <table id="users" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Perfil</th>
                                <th>Email</th>
                                <th>Senha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->nome}}</td>
                                <td>{{$user->perfil}}</td>
                                <td>{{$user->email}}</td>
                                <td>123456</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
