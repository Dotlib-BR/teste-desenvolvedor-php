@extends('layouts.app')
@section('content')
    <div class="container clientes">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Clientes
                        @if(Auth::user()->perfil == 1)
                            <a class="btn btn-outline-light float-right" href="{{route('clientes.create')}}" role="button">Novo Cliente</a>
                        @endif
                    </div>
                    @if(Auth::user()->perfil == 1)
                        <div class="card-body">                   
                            <div class="row">
                                <div class="col">
                                    <form class="form-inline select" method="get" action="{{route('clientes')}}" class="">       
                                        
                                        <label class="sr-only">Filtrar por</label>
                                        <div class="input-group mb-2 mr-sm-2 my-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Filtrar por</div>
                                            </div>
                                            <select name="where[]" class="custom-select tpFiltro" id="">
                                                <option value="" selected>Escolha</option>
                                                <option value="id">Nº do Cliente</option>
                                                <option value="nome">Nome </option>
                                                <option value="email">E-mail</option>
                                                <option value="cpf">CPF</option>
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
                                                <option value="id">Nº do Cliente</option>
                                                <option value="nome">Nome </option>
                                                <option value="email">E-mail</option>
                                                <option value="cpf">CPF</option>
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
                                            <a class="btn btn-danger" href="{{route('clientes')}}" role="button">Limpar</a>
                                        </div>                                      
                                            
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    @endif
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
                                @if(Auth::user()->perfil == 1)
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input all" type="checkbox" value="" id="">
                                                <label class="form-check-label" for="">
                                                <i class="fas fa-trash-alt deletarAll" id="cliente"></i>
                                                </label>
                                        </div>
                                    </th>
                                @endif
                                <th scope="col">Nº do Cliente</th>
                                <th scope="col" id="">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">CPF</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($clientes)>0)
                                @foreach($clientes as $cliente)
                                    @can('view', $cliente)
                                        <tr>
                                            @if(Auth::user()->perfil == 1)
                                                <td scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="delete[]" value="{{$cliente->id}}" >
                                                    </div>
                                                </td>
                                            @endif
                                            <td>{{$cliente->id}}</td>
                                            <td>{{$cliente->nome}}</td>
                                            <td>{{$cliente->email}}</td>
                                            <td>{{$cliente->cpf}}</td>
                                            <td>
                                                @if(Auth::user()->perfil == 1)
                                                    <a class="btn btn-outline-primary" href="{{route('clientes.show', $cliente->id)}}" role="button">Visualizar</a>
                                               
                                                    <a class="btn btn-outline-danger deletar" model="cliente" data-deletar="{{$cliente->id}}" role="button">Deletar</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endcan
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align:center;">
                                        Não há clientes cadastrados
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if(Auth::user()->perfil == 1)
                        @isset($clientes)
                            {{ $clientes->links() }}
                        @endisset
                    @endif
                    <form action="{{route('clientes.delete')}}" method="post" id="form-deletar">
                        @csrf
                        <input type="hidden" name="id">
                    </form>
                </div>                
            </div>
        </div>
    </div>
@endsection