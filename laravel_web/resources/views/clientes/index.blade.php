@extends('layouts.app')

@section('template_title', 'Clientes')

@section('content')

    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Clientes Cadastrados</h2>
        </div>
        <div class="card-body p-5">
            <div class="row mb-3">
                <div class="col-11 col-md-11">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-double"></i>&nbsp;&nbsp; {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @elseif ($message = Session::get('erro'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp; {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-1 col-md-1">
                    <a href="{{route('clientes-create')}}" class="btn btn-outline-success"><i class="fa fa-user-plus"></i></a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">CPF</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <th scope="row">{{$cliente->id}}</th>
                                <td><a href="{{route('clientes-show', ['id' => $cliente->id])}}" class="text-decoration-none text-black"><i class="fas fa-stream text-info"></i> {{$cliente->nome}}</a></td>
                                <td>{{$cliente->email}}</td>
                                <td>{{$cliente->cpf}}</td>
                                @if ($cliente->status == 1)
                                    <td class="text-center"><span class="badge bg-success">Ativo</span></td>
                                @else
                                    <td class="text-center"><span class="badge bg-secondary">Inativo</span></td>
                                @endif
                                <td class="d-flex gap-2 justify-content-center">
                                    <a href="{{route('clientes-edit', ['id' => $cliente->id])}}" class="btn btn-outline-primary"><i class="fas fa-user-edit"></i></a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cliente-{{$cliente->id}}"><i class="fas fa-user-times"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="cliente-{{$cliente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Excluir cliente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="m-0 p-0">Você realmente deseja excluir <b>{{$cliente->nome}}</b>?</p>
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Todos os pedidos relacionados a este cliente será excluído!</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                            <form action="{{route('clientes-destroy', ['id' => $cliente->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Sim</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection