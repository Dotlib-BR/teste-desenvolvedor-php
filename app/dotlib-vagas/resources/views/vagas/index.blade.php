@extends('template.template') @section('conteudo')

    <div class="container-fluid conteudo">
        <h4 class="ml-4 pt-3">Vagas</h4>
        <div class="row div-botoes">
            <div class="col-md-2 ">
                <a href="{{ url('vagas/create') }}" class="btn btn-success mb-2">
                    Nova Vaga
                </a>
            </div>
            <div class="col-md-10">
                <form action="/vagas/pesquisar" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-row">
                        <div class="form-group mb-2 col-12 col-sm-10 col-md-10 col-lg-10" >
                            <input
                                type="text"
                                class="form-control"
                                name="texto_busca"
                                placeholder="Pesquisar..."
                                value="{{Session::get('texto_busca') ?? ''}}"
                            />
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 col-12 col-sm-2 col-md-2 col-lg-2">
                            Pesquisar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 scroll-table">
                <div class="table-responsive">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-1" scope="col">
                                <a
                                    class="ordenar"
                                    href="{{url("vagas/pesquisar/id")}}"
                                >
                                    Código
                                    <i class="fas fa-arrows-alt-v"></i>

                                </a>
                            </th>
                            <th class="col-md-2" scope="col">
                                <a
                                    class="ordenar"
                                    href="{{url("vagas/pesquisar/titulo")}}"
                                >
                                    Título
                                    <i class="fas fa-arrows-alt-v"></i>

                                </a>
                            </th>
                            <th  class="col-md-3"  scope="col">
                                <a
                                    class="ordenar"
                                    href="{{url("vagas/pesquisar/descricao")}}"
                                >
                                    Descrição
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                             </th>
                            <th class="col-md-2"  scope="col-2">
                                <a
                                    class="ordenar"
                                    href="{{url("vagas/pesquisar/tipo_contratacao")}}"
                                >
                                    Contratação
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-1"  scope="col-2">
                                <a
                                    class="ordenar"
                                    href="{{url("vagas/pesquisar/alocacao")}}"
                                >
                                    Alocação
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-1"  scope="col-1">
                                <a
                                    class="ordenar"
                                    href="{{url("vagas/pesquisar/salario")}}"
                                >
                                    Salário
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-1" scope="col-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($vagas as $obj)
                                <tr class="{{ $obj->pausada ? 'vaga-pausada' : '' }}">
                                    <td class="col-md-1" scope="row">{{ $obj->id }}</td>
                                    <td class="col-md-2" >{{ $obj->titulo }}</td>
                                    <td class="col-md-3" >{{ $obj->descricao }}</td>
                                    <td class="col-md-2" >{{ $obj->tipo_contratacao }}</td>
                                    <td class="col-md-1" >{{ $obj->alocacao }}</td>
                                    <td class="col-md-1" >{{ $obj->getSalario() }}</td>
                                    <td class="col-md-2 col-lg-2 text-center">
                                        @if(!$obj->pausada)
                                            <button type="button"  name="{{url("vagas/pausar/$obj->id")}}"
                                                    data-toggle="tooltip" data-placement="top" title="Pausar a vaga"
                                                    onclick="alterarRegistro(this.name)"  class="btn btn-secondary">
                                                <i class="fas fa-pause-circle"></i>
                                            </button>
                                        @endif
                                        <a
                                            data-toggle="tooltip" data-placement="top" title="Editar a vaga"
                                            class="btn btn-info"
                                            href="{{url("vagas/$obj->id/edit")}}"
                                        ><i class="fas fa-edit"></i></a
                                        >
                                        <button type="button"
                                                data-toggle="tooltip" data-placement="top" title="Excluir a vaga"
                                                name="{{url("vagas/$obj->id")}}"
                                                onclick="deleteRegistro(this.name)"  class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ( sizeof($vagas) <= 0)
                    <h3 style="text-align: center;">Nenhuma vaga encontrada</h3>
                @endif

            </div>
            <div class="legenda">
                <i class="fas fa-square"></i><label>Vaga pausada</label>
            </div>

            <div class="pagination-initial d-flex justify-content-center">
                <label class="label-pagination">{{$vagas->lastItem() ?? '0' }} de {{$vagas->total() ?? '0'}}</label> {{$vagas->links()}}
            </div>
        </div>
    </div>
@endsection
