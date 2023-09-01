@extends('layouts.app-master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Vagas de Emprego</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Vagas de Emprego</li>
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
                        Gerenciador de Vagas de Emprego
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right">Adicionar Vaga</a>
                    </div>

                    <div class="mt-2">
                        @include('layouts.partials.messages')
                    </div>


                    <table class="table table-bordered table-striped" id="vacancies">
                        <tr>
                            <th scope="col" width="1%">Nº</th> 
                            <th scope="col" width="5%">Título</th>
                            <th scope="col" width="5%">Descrição</th>
                            <th scope="col" width="1%">Tipo</th>
                            <th scope="col" width="1%">Status</th>
                            <th scope="col" width="1%" colspan="3" style="text-align:center">Ação</th>
                        </tr>
                        @foreach ($posts as $key => $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->type }}</td>
                            <td style="text-align:center">@if($post->status == 1) <b style="color:green">ATIVA</b>
                                @elseif($post->status == 2) echo <b style="color:brown">PAUSADA</b>
                                @elseif($post->status == 3) echo <b style="color:red">CANCELADA</b>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('posts.show', $post->id) }}">Mostrar</a>
                            </td>
                            <td>
                                @role('admin')
                                <a class="btn btn-primary btn-sm" href="{{ route('posts.edit', $post->id) }}">Editar</a>
                                @endrole
                            </td>
                            <td>
                                @role('admin')
                                {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Deletar', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="d-flex">
                        {!! $posts->links() !!}
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
