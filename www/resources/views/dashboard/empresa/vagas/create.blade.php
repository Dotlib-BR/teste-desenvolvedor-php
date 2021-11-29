@extends('layouts.empresa')

@section('cssAfter')
<link href="{{ asset("tagsinput/css/amsify.suggestags.css") }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session()->has('message'))
                <div class="alert alert-info">{{session()->get('message')}}</div>
            @endif
            <div class="card border-primary mb-3">
                <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.empresa.vagas.store') }}">
                        @csrf

                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">Dados da Vaga</div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-12 col-md-12">
                                        <label for="nome" class="col-md-4 col-form-label text-md-right">Titulo da vaga</label>

                                        <div class="col-md-12">
                                            <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}" required autocomplete="titulo" autofocus>

                                            @error('titulo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-3 col-md-3">
                                        <label for="nivel" class="col-md-4 col-form-label text-md-right">Nível</label>

                                        <div class="col-md-12">
                                            <select name="nivel" id="nivel" class="form-control @error('nivel') is-invalid @enderror" required>
                                                <option value="" >Selecionar</option>
                                                <option value="junior" {{old('nivel') == 'junior' ? 'selected' : ''}}>Junior</option>
                                                <option value="pleno" {{old('nivel') == 'pleno' ? 'selected' : ''}}>Pleno</option>
                                                <option value="senior" {{old('nivel') == 'senior' ? 'selected' : ''}}>Senior</option>
                                            </select>

                                            @error('nivel')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-3">
                                        <label for="categoria" class="col-md-4 col-form-label text-md-right">Categoria</label>

                                        <div class="col-md-12">
                                            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                                                <option value="">Selecionar</option>
                                                <option value="CLT" {{old('categoria') == 'CLT' ? 'selected' : ''}}>CLT</option>
                                                <option value="PJ" {{old('categoria') == 'PJ' ? 'selected' : ''}}>Pessoa Juridica</option>
                                                <option value="Freelancer" {{old('categoria') == 'Freelancer' ? 'selected' : ''}}>Freelancer</option>
                                            </select>

                                            @error('categoria')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-3">
                                        <label for="regime" class="col-md-4 col-form-label text-md-right">Regime</label>

                                        <div class="col-md-12">
                                            <select name="regime" id="regime" class="form-control @error('regime') is-invalid @enderror" required>
                                                <option value="">Selecionar</option>
                                                <option value="presencial" {{ old('regime') == 'presencial' ? 'selected' : ''}}>Presencial</option>
                                                <option value="remoto" {{ old('regime') == 'remoto' ? 'selected' : ''}}>Remoto</option>
                                            </select>

                                            @error('regime')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3 col-md-3">
                                        <label for="salario" class="col-md-4 col-form-label text-md-right">Salário</label>

                                        <div class="col-md-12">
                                            <input id="salario" type="text" class="form-control @error('salario') is-invalid @enderror" name="salario" value="{{ old('salario') }}" required autocomplete="salario" autofocus>

                                            @error('salario')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-12">
                                        <label class="col-form-label">Tecnologias</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="tags">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-12">
                                        <label for="descricao" class="col-md-4 col-form-label text-md-right">Descrição da vaga</label>

                                        <div class="col-md-12">
                                            <textarea name="descricao" rows="5" cols="40" class="form-control tinymce-editor">{!! old('descricao') !!}</textarea>

                                            @error('descricao')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">

                                    <div class="col-3 col-md-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_paused" value="1" id="vaga_pausada" @if(old('is_paused') == 1) checked @endif>
                                                    <label class="form-check-label" for="vaga_pausada">
                                                        Pausar a vaga?
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script src="{{ asset("tagsinput/js/jquery.amsify.suggestags.js") }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],

        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
    });

    var suggestions = [];
    $.ajax({
        url: '{{route("dashboard.empresa.tags.json") }}',
        type : 'GET',
        success: function(data) {
            for(var i = 0; i < data.length; i++){
                suggestions[i] = {tag: data[i].nome, value: data[i].id}
            }
            createTags(suggestions);
        },
    });

    function createTags(data)
    {
        $('input[name="tags"]').amsifySuggestags({
            type: 'bootstrap',
            minChars: 2,
            suggestions: data,
            whiteList: true
        });
    }
</script>

@endsection
