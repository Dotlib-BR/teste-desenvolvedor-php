@extends('layouts.app')
@section('content')
    <div class="container clientes">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Produtos
                        @if(Auth::user()->perfil == 1)
                            <a class="btn btn-outline-light float-right" href="{{route('produtos.create')}}" role="button">Novo Produto</a>
                        @endif
                    </div>
                    <div class="card-body">                   
                        <div class="row">
                            <div class="col">
                                <form class="form-inline select" method="get" action="{{route('produtos')}}" class="">      
                                    
                                    <label class="sr-only">Filtrar por</label>
                                    <div class="input-group mb-2 mr-sm-2 my-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Filtrar por</div>
                                        </div>
                                        <select name="where[]" class="custom-select tpFiltro" id="">
                                            <option value="" selected>Escolha</option>
                                            <option value="id">Cód Produto</option>
                                            <option value="nome">Nome</option>
                                            <option value="descricao">Descrição</option>
                                            <option value="codbarras">Cód barras</option>
                                            <option value="valorUnt">Valor</option>
                                        </select>
                                    </div> 
                                    <div class="form-check mb-2 mr-sm-2 my-1"> 
                                        <input type="text" class="form-control" id="filtro" name="where[]"> 
                                    </div> 
                                    <label class="sr-only">Ordenar por</label>
                                    <div class="input-group mb-2 mr-sm-2 my-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Ordenar por</div>
                                        </div>
                                        <select name="order" class="custom-select tpOrder" id="">
                                            <option value="" selected>Escolha</option>
                                            <option value="id">Cód Produto</option>
                                            <option value="nome">Nome</option>
                                            <option value="descricao">Descrição</option>
                                            <option value="codbarras">Cód barras</option>
                                            <option value="valorUnt">Valor</option>
                                        </select>
                                    </div> 
                                    <label class="sr-only">Nº Registro</label> 
                                        <div class="input-group mb-2 mr-sm-2 my-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Nº Registro</div>
                                            </div>
                                            <input type="text" class="form-control" id="page" name="limit"> 
                                        </div>  
                                        <div>
                                            <button type="submit" class="btn btn-primary">OK</button>   
                                            <a class="btn btn-danger" href="{{route('produtos')}}" role="button">Limpar</a>
                                        </div>                                     
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                             @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>                    
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check">
                                        @if(Auth::user()->perfil == 1)
                                            <input class="form-check-input all" type="checkbox" value="" id="">
                                            <label class="form-check-label" for="">
                                            <i class="fas fa-trash-alt deletarAll" id="produto"></i>
                                            </label>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col">Cód. Produto</th>
                                <th scope="col" id="">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Cód. Barras</th>
                                <th scope="col">Valor</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($produtos)>0)
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td scope="row">
                                            @if(Auth::user()->perfil == 1)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="delete[]" value="{{$produto->id}}" >
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{$produto->id}}</td>
                                        <td>{{$produto->nome}}</td>
                                        <td>{{$produto->descricao}}</td>
                                        <td>{{$produto->codbarras}}</td>
                                        <td>R$ {{number_format($produto->valorUnt, 2, ',', ' ')}}</td>
                                        <td>
                                            @if(Auth::user()->perfil == 1)  
                                                <a class="btn btn-outline-primary" href="{{route('produtos.edit', $produto->id)}}" role="button">Visualizar</a>
                                                <a class="btn btn-outline-danger deletar" model="produto" data-deletar="{{$produto->id}}" role="button">Deletar</a>
                                            @else
                                                <a class="btn btn-outline-primary" href="{{route('produtos.show', $produto->id)}}" role="button">Visualizar</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" style="text-align:center;">
                                        Não há produtos cadastrados
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @isset($produtos)
                        {{ $produtos->links() }}
                    @endisset
                    <form action="{{route('produtos.delete')}}" method="post" id="form-deletar">
                        @csrf
                        <input type="hidden" name="id">
                    </form>
                    
                </div>                
            </div>
        </div>
    </div>
@endsection