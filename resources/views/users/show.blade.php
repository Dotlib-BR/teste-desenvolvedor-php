@extends('layouts.app-master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Usuários</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Usuários</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="bg-light p-4 rounded">
                    <div class="container mt-4">
                        <div class="lead">
                            Informações do usuário <b>"{{ ucfirst($user->name) }}"</b>
                        </div>
                            <div>
                                Nome: {{ $user->name }}
                            </div>
                            <div>
                                E-mail: {{ $user->email }}
                            </div>
                            <div>
                                Username: {{ $user->username }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Editar</a>
                        <a href="{{ route('users.index') }}" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

