@extends('layouts.main')

@section('title', 'Edição de Cliente')

@section('content')
    <div class="container-fluid">
        <div class="border rounded mt-3">
            <form autocomplete="off" id="form-client" class="p-3" method="POST" action="{{ isset($client) ? route('dashboard.clients.update', ['client' => $client->id]) : route('dashboard.clients.store') }}">

                @csrf

                @if(isset($client))
                    @method('PUT')
                @endif

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" placeholder="Nome" name="name" value="{{ old('name', @$client->name) }}">

                        @if ($errors->has('name'))
                            <div class="invalid-feedback font-weight-bold d-block">
                                {{ $errors->first('name') }}
                            </div>
                        @endif

                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Informe o Email" name="email" value="{{ old('email', @$client->email) }}">

                        @if ($errors->has('email'))
                            <div class="invalid-feedback font-weight-bold d-block">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control cpf" id="cpf" placeholder="Informe o CPF" name="cpf" value="{{ old('cpf', @$client->cpf) }}">

                        @if ($errors->has('cpf'))
                            <div class="invalid-feedback font-weight-bold d-block">
                                {{ $errors->first('cpf') }}
                            </div>
                        @endif

                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Salvar" />
                </div>
            </form>
        </div>
    </div>
    <script defer>
        $(function () {
            $('.cpf').mask('000.000.000-00');// Aplicando máscara com Jquery Mask Plugin

            //INICIO DO SCRIPT DE VALIDAÇÃO COM PLUGIN JQUERY VALIDATION
            $('#form-client').validate({ // Inicializa o plugin
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: false,
                        email: true,
                        maxlength: 255
                    },
                    cpf: {
                        cpf: true,
                        required: true
                    }
                },
            });
            //FIM DO SCRIPT DE VALIDAÇÃO COM PLUGIN JQUERY VALIDATION
            
            // $('#form-client').on('submit', function () {
            //     event.preventDefault();
            //
            //     $('#cpf').val($('#cpf').val().replace(/[^\d]+/g,''));
            //     // Preciso retirar a máscara no front e no back
            //
            //     this.submit();
            // });
        })
    </script>
@endsection
