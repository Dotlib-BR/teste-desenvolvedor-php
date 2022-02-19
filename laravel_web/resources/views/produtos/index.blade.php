@extends('layouts.app')

@section('template_title', 'Produtos')

@section('content')

    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Produtos Cadastrados</h2>
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
                    <a href="{{route('produtos-create')}}" class="btn btn-outline-success"><i class="fas fa-plus fa-1x"></i></a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col" class="text-center">Quantidade</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <th scope="row">{{$produto->id}}</th>
                                <td><a href="{{route('produtos-show', ['id' => $produto->id])}}" class="text-decoration-none text-black"><i class="fas fa-stream text-info"></i> {{$produto->nome}}</a></td>
                                <td>R$ {{$produto->valor}}</td>
                                <td class="text-center">
                                    @if ($produto->quantidade >= 75)
                                        <span class="badge bg-success">{{$produto->quantidade}} un</span>

                                    @elseif ($produto->quantidade < 75 && $produto->quantidade >= 25)
                                        <span class="badge bg-info">{{$produto->quantidade}} un</span>

                                    @else
                                        <span class="badge bg-danger">{{$produto->quantidade}} un</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($produto->status == 1)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-secondary">Inativo</span>
                                    @endif
                                </td>
                                <td class="d-flex gap-2 justify-content-center">
                                    <a href="{{route('produtos-edit', ['id' => $produto->id])}}" class="btn btn-outline-primary"><i class="fas fa-pen"></i></a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#produto-{{$produto->id}}"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="produto-{{$produto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Excluir produto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="m-0 p-0">Você realmente deseja excluir <b>{{$produto->nome}}</b>?</p>
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Todos os pedidos relacionados a este produto será excluído!</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                            <form action="{{route('produtos-destroy', ['id' => $produto->id])}}" method="post">
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