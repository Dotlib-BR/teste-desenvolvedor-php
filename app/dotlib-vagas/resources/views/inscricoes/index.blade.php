@extends('template.template') @section('conteudo')

    <div class="container-fluid conteudo">
        <h4 class="ml-4 pt-3">Inscrições</h4>
        <div class="row div-botoes">
            <div class="col-md-12">
                <form action="/inscricoes/pesquisar" method="POST">
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
                            <th class="col-md-2" scope="col">
                                <a
                                    class="ordenar"
                                    href="{{url("inscricoes/pesquisar/id")}}"
                                >
                                    Cód. Vaga
                                    <i class="fas fa-arrows-alt-v"></i>

                                </a>
                            </th>
                            <th class="col-md-3" scope="col">
                                <a
                                    class="ordenar"
                                    href="{{url("inscricoes/pesquisar/titulo")}}"
                                >
                                    Título
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-2"  scope="col-2">
                                <a
                                    class="ordenar"
                                    href="{{url("inscricoes/pesquisar/tipo_contratacao")}}"
                                >
                                    Contratação
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-2"  scope="col-2">
                                <a
                                    class="ordenar"
                                    href="{{url("inscricoes/pesquisar/alocacao")}}"
                                >
                                    Alocação
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-2"  scope="col-2">
                                <a
                                    class="ordenar"
                                    href="{{url("inscricoes/pesquisar/name")}}"
                                >
                                    Nome
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-3"  scope="col-2">
                                <a
                                    class="ordenar"
                                    href="{{url("inscricoes/pesquisar/email")}}"
                                >
                                    Email
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-1" scope="col-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($inscricoes as $obj)
                                <tr  class="{{ $obj->pausada ? 'vaga-pausada' : '' }}">
                                    <td  class="col-md-2" scope="row">{{ $obj->id }}</td>
                                    <td  class="col-md-3" >{{ $obj->titulo }}</td>
                                    <td  class="col-md-2" >{{ $obj->tipo_contratacao }}</td>
                                    <td  class="col-md-2" >{{ $obj->alocacao }}</td>
                                    <td  class="col-md-2" >{{ $obj->name }}</td>
                                    <td  class="col-md-3" >{{ $obj->email }}</td>
                                    <td class="col-md-2 col-lg-2 text-center">
                                        <button type="button"
                                                data-toggle="tooltip" data-placement="top" title="Detalhes da vaga"
                                                onclick="detalheVaga({{$obj}})" class="btn btn-warning">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ( sizeof($inscricoes) <= 0)
                    <h3 style="text-align: center;">Nenhuma inscrição encontrada</h3>
                @endif

            </div>
            <div class="legenda">
                <i class="fas fa-square"></i><label>Vaga pausada</label>
            </div>

            <div class="pagination-initial d-flex justify-content-center">
                <label class="label-pagination">{{$inscricoes->lastItem() ?? '0' }} de {{$inscricoes->total() ?? '0'}}</label> {{$inscricoes->links()}}
            </div>
        </div>
    </div>

    @include('vagas.modal-detalhe')
@endsection
