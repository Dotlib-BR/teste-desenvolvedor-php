@extends('template.template')
@section('conteudo')

    <div class="container-fluid conteudo">
        <h4 class="ml-4 pt-3">Candidatos</h4>
        <div class="row div-botoes">
            <div class="col-md-2 ">
                <a href="{{ url('users/create') }}" class="btn btn-success mb-2">
                    Nova Vaga
                </a>
            </div>
            <div class="col-md-10">
                <form action="/users/pesquisar" method="POST">
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
                                    href="{{url("users/pesquisar/id")}}"
                                >
                                    Código
                                    <i class="fas fa-arrows-alt-v"></i>

                                </a>
                            </th>
                            <th class="col-md-3" scope="col">
                                <a
                                    class="ordenar"
                                    href="{{url("users/pesquisar/name")}}"
                                >
                                    Nome
                                    <i class="fas fa-arrows-alt-v"></i>

                                </a>
                            </th>
                            <th  class="col-md-3"  scope="col">
                                <a
                                    class="ordenar"
                                    href="{{url("users/pesquisar/last_name")}}"
                                >
                                    Sobre Nome
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                             </th>
                            <th class="col-md-3"  scope="col-2">
                                <a
                                    class="ordenar"
                                    href="{{url("users/pesquisar/email")}}"
                                >
                                    Email
                                    <i class="fas fa-arrows-alt-v"></i>
                                </a>
                            </th>
                            <th class="col-md-1" scope="col-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $obj)
                                <tr>
                                    <td class="col-md-1" scope="row">{{ $obj->id }}</td>
                                    <td class="col-md-2" >{{ $obj->name }} </td>
                                    <td class="col-md-3" >{{ $obj->last_name }}</td>
                                    <td class="col-md-2" >{{ $obj->email }}</td>
                                    <td class="col-md-2 col-lg-2 text-center">
                                        <a
                                            class="btn btn-info"
                                            href="{{url("users/$obj->id/edit")}}"
                                        ><i class="fas fa-edit"></i></a
                                        >
                                        <button type="button"  name="{{url("users/$obj->id")}}"
                                                onclick="deleteRegistro(this.name)"  class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ( sizeof($users) <= 0)
                    <h3 style="text-align: center;">Nenhum candidato encontrado</h3>
                @endif

            </div>
            <div class="pagination-initial d-flex justify-content-center">
               <label class="label-pagination">{{$users->lastItem() ?? '0' }} de {{$users->total() ?? '0'}}</label> {{$users->links()}}
            </div>
        </div>
    </div>
@endsection
