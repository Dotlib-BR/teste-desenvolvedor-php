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
                    <div class="container mt-4">
                    <div>
                        <b>Título da Vaga:</b>  {{ $post->title }} 
                    </div>
                    <div>
                        <b>Descrição da Vaga:</b>  {{ $post->description }}
                    </div>
                    <div>
                        <b>Informações da Vaga:</b>  {{ $post->body }}
                    </div>
                    <div>
                        <b>Tipo de Contratação:</b>  {{ $post->type }}
                    </div>
                </div>


                <div class="mt-4">
                    <form method="POST" action="{{ route('posts.apply') }}">
                    @csrf
                        <input value="{{ Auth::user()->id }}" type="hidden" name="userid"/>
                        <input value="{{ $post->id }}" type="hidden" name="postid"/>
                        <button type="submit" class="btn btn-primary">Candidatar à Vaga</button>
                    </form>
                    <br>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Editar</a>
                    <a href="{{ route('posts.index') }}" class="btn btn-default">Voltar</a>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
