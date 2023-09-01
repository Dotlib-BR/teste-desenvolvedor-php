@extends('layouts.app-master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Regras</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Regras</li>
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
                            Permissões atribuídas para a regra <b>"{{ ucfirst($role->name) }}"</b>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <th scope="col" width="20%">Nome</th>
                                <!-- <th scope="col" width="1%">Guarda</th> -->
                            </thead>

                            @foreach($rolePermissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <!-- <td>{{ $permission->guard_name }}</td> -->
                                </tr>
                            @endforeach
                        </table>
                        <div class="mt-4">
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('roles.index') }}" class="btn btn-default">Voltar</a>
                        </div>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

