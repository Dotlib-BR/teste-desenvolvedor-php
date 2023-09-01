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
                        Adicionar nova vaga de emprego.
                    </div>
                    <div class="container mt-4">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Houveram alguns problemas com sua solicitação.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif 

                        <form method="POST" action="{{ route('posts.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Título da Vaga</label>
                                <input value="{{ old('title') }}"
                                    type="text"
                                    class="form-control"
                                    name="title"
                                    placeholder="Insira o título da vaga" required>

                                @if ($errors->has('title'))
                                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição da Vaga</label>
                                <input value="{{ old('description') }}"
                                    type="text"
                                    class="form-control"
                                    name="description"
                                    placeholder="Insira uma breve descrição da vaga" required>

                                @if ($errors->has('description'))
                                    <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="body" class="form-label">Informações da Vaga</label>
                                <textarea class="form-control"
                                    name="body" rows="8"
                                    placeholder="Insira as informações sobre a vaga" required>{{ old('body') }}</textarea>

                                @if ($errors->has('body'))
                                    <span class="text-danger text-left">{{ $errors->first('body') }}</span>
                                @endif
                            </div>



                            <div class="mb-3">
                                <label for="type" class="form-label">Tipo de Contratação</label>
                                </br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="CLT" checked/>
                                    <label class="form-check-label" for="inlineRadio1">CLT</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="Pessoa Jurídica" />
                                    <label class="form-check-label" for="inlineRadio2">Pessoa Jurídica</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="Freelancer" />
                                    <label class="form-check-label" for="inlineRadio3">Freelancer</label>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="1" />
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


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endsection