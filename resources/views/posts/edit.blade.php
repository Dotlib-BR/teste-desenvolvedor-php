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
                        Editar vaga de emprego <b>"{{ ucfirst($post->title) }}"</b>.
                    </div>

                    <div class="container mt-4">

                        <form method="POST" action="{{ route('posts.update', $post->id) }}">
                            @method('patch')
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input value="{{ $post->title }}"
                                    type="text"
                                    class="form-control"
                                    name="title"
                                    placeholder="Title" required>

                                @if ($errors->has('title'))
                                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input value="{{ $post->description }}"
                                    type="text"
                                    class="form-control"
                                    name="description"
                                    placeholder="Description" required>

                                @if ($errors->has('description'))
                                    <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    name="body" rows="8"
                                    placeholder="Body" required>{{ $post->body }}</textarea>

                                @if ($errors->has('body'))
                                    <span class="text-danger text-left">{{ $errors->first('body') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Tipo de Contratação</label>
                                </br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="CLT" 
                                    @if($post->type == 'CLT') checked @endif/>
                                    <label class="form-check-label" for="inlineRadio1">CLT</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="Pessoa Jurídica" 
                                    @if($post->type == 'Pessoa Jurídica') checked @endif/>
                                    <label class="form-check-label" for="inlineRadio2">Pessoa Jurídica</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="Freelancer" 
                                    @if($post->type == 'Freelancer') checked @endif/>
                                    <label class="form-check-label" for="inlineRadio3">Freelancer</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-default">Voltar</a>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
