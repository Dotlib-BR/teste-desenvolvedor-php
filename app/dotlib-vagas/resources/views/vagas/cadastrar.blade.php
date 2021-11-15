@extends('template.template') @section('conteudo')
    <div class="container-md conteudo">
            <h3 class="modal-title pt-3">
                @if(isset($vaga)) Editar @else Cadastrar nova @endif vaga
            </h3>
            @if(Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                </div>
            @endif

            @if(isset($vaga) && !empty($vaga->id))
                <form action="{{url("vagas/$vaga->id")}}" method="POST"> @method('PUT')
            @else
                <form action="/vagas" method="POST">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" id="id_vaga" value="" />
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-8 ">
                        <label for="titulo">Título *</label>
                        <input
                            autofocus
                            type="text"
                            class="form-control"
                            id="titulo"
                            name="titulo"
                            value="{{$vaga->titulo ?? old('titulo')}}"
                        />
                        @if ($errors->has('titulo'))
                            <span class="help-block text-danger">
                              <strong>{{ $errors->first('titulo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="salario">Salário</label>
                        <input
                            autofocus
                            type="text"
                            class="form-control"
                            id="salario"
                            name="salario"
                            value="{{$vaga->salario ?? old('salario')}}"
                        />
                        @if ($errors->has('salario'))
                            <span class="help-block text-danger">
                              <strong>{{ $errors->first('salario') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="descricao">Descrição *</label>
                        <textarea
                            type="text"
                            rows="4"
                            cols="50"
                            class="form-control"
                            id="descricao"
                            name="descricao"
                        > {{{ $vaga->descricao ?? old('descricao') }}} </textarea>
                        @if ($errors->has('descricao'))
                            <span class="help-block text-danger">
                              <strong>{{ $errors->first('descricao') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="requisito_obrigatorio">Requisitos Obrigatórios *</label>
                        <textarea
                            type="text"
                            rows="4"
                            cols="50"
                            class="form-control"
                            id="requisito_obrigatorio"
                            name="requisito_obrigatorio"
                            placeholder=""
                        >{{{$vaga->requisito_obrigatorio ?? old('requisito_obrigatorio')}}}</textarea>
                        @if ($errors->has('requisito_obrigatorio'))
                            <span class="help-block text-danger">
                              <strong>{{ $errors->first('requisito_obrigatorio') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="requisito_diferencial">Diferencial</label>
                        <textarea
                            type="text"
                            rows="4"
                            cols="50"
                            class="form-control"
                            id="requisito_diferencial"
                            name="requisito_diferencial"
                            placeholder=""
                        > {{{$vaga->requisito_diferencial ?? old('requisito_diferencial')}}}</textarea>
                        @if ($errors->has('requisito_diferencial'))
                            <span class="help-block text-danger">
                              <strong>{{ $errors->first('requisito_diferencial') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="beneficios">Benefícios</label>
                        <textarea
                            type="text"
                            rows="4"
                            cols="50"
                            class="form-control"
                            id="beneficios"
                            name="beneficios"
                            placeholder=""
                        > {{{$vaga->beneficios ?? old('beneficios')}}}</textarea>
                        @if ($errors->has('beneficios'))
                            <span class="help-block text-danger">
                              <strong>{{ $errors->first('beneficios') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 ">
                        <label for="tipo_contratacao_id">Contratação *</label>
                        <select name="tipo_contratacao_id" id="tipo_contratacao_id" class="form-control" value="">
                            <option value="" disabled="" selected="">Selecione</option>
                            @if(isset($tipoContratacaoLista))
                                @foreach($tipoContratacaoLista as $contratacao)
                                    <option value="{{ $contratacao->id }}"
                                        @if(isset($vaga))
                                            @if ($vaga->tipo_contratacao_id == $contratacao->id)
                                            selected="selected"
                                            @endif
                                        @endif
                                        @if (old('tipo_contratacao_id') == $contratacao->id)
                                             selected="selected"
                                        @endif
                                    >{{ $contratacao->descricao }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('tipo_contratacao_id'))
                            <span class="help-block text-danger">
                              <strong>{{ $errors->first('tipo_contratacao_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nome">Alocação</label>
                        <select name="alocacao" id="alocacao" class="form-control" value="">
                            <option value="">Selecione</option>
                            <option value="Home office"
                                @if(isset($vaga->alocacao))
                                    @if ($vaga->alocacao == 'Home office')
                                        selected="selected"
                                    @endif
                                @endif
                                @if (old('alocacao') == 'Home office')
                                    selected="selected"
                                @endif>Home office</option>
                            <option value="Híbrido"
                                @if(isset($vaga->alocacao))
                                    @if ($vaga->alocacao == 'Híbrido')
                                    selected="selected"
                                    @endif
                                @endif
                                @if (old('alocacao') == 'Híbrido')
                                     selected="selected"
                                @endif
                            >Híbrido</option>
                            <option value="Presencial"
                                @if(isset($vaga->alocacao))
                                    @if ($vaga->alocacao == 'Presencial')
                                    selected="selected"
                                    @endif
                                @endif
                                @if (old('alocacao') == 'Presencial')
                                    selected="selected"
                                @endif
                            >Presencial</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nome">Pausada</label>
                        <select name="pausada" id="pausada" class="form-control" value="">
                            <option value="">Selecione</option>
                            <option value="1"
                                    @if(isset($vaga))
                                        @if ($vaga->pausada == '1')
                                            selected="selected"
                                        @endif
                                    @endif
                                    @if (old('pausada') == '1')
                                        selected="selected"
                                    @endif> Sim
                            </option>
                            <option value="0"
                                    @if(isset($vaga))
                                        @if ($vaga->pausada == '0')
                                            selected="selected"
                                        @endif
                                    @endif
                                    @if (old('pausada') == '0')
                                         selected="selected"
                                    @endif> Não
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <a href="{{ url('vagas') }}" class="btn btn-danger ml-3 mb-3">
                Cancelar
            </a>
            <button type="submit" class="btn btn-success mb-3">
                Salvar
            </button>
        </form>
    </div>
@endsection
