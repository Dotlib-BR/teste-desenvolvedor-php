@extends('layouts.app-master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permissões</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Permissões</li>
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
                    <div class="lead">
                        Gerenciador de Permissões
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Adicionar Permissão</a>
                    </div>

                    <div class="mt-2">
                        @include('layouts.partials.messages')
                    </div>

                    {{-- <table class="table table-striped"> --}}
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="1%">Nº</th>
                            <th>Nome</th>
                            <th width="3%" colspan="3" style="text-align:center">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Editar</a></td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Deletar', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex">
                        {{-- {!! $permissions->links() !!} --}}
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    <!-- /.content -->
    </div>
<!-- /.content-wrapper -->
@endsection
