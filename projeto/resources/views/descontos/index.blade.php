@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Cupons
                        <a class="btn btn-outline-light float-right" href="{{route('descontos.create')}}" role="button">Novo Cupom</a>
                    </div>
                    <div class="card-body">                   
                        <div class="row">
                            <div class="col">
                                <form class="form-inline select" method="get" action="{{route('descontos')}}" class="">       
                                    @csrf 
                                    <label class="sr-only">Filtrar por</label>
                                    <div class="input-group mb-2 mr-sm-2 my-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Filtrar por</div>
                                        </div>
                                        <select name="where[]" class="custom-select tpFiltro" id="">
                                            <option value="" selected>Escolha</option>
                                            <option value="id">Nº Cupom</option>
                                            <option value="nome">Cupom</option>
                                            <option value="valor">Valor</option>
                                            <option value="Validade">Validade</option>
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
                                            <option value="id">Nº Cupom</option>
                                            <option value="nome">Cupom</option>
                                            <option value="valor">Valor</option>
                                            <option value="Validade">Validade</option>
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
                                        <a class="btn btn-danger" href="{{route('descontos')}}" role="button">Limpar</a>
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
                                        
                                        <input class="form-check-input all" type="checkbox" value="" id="">
                                        <label class="form-check-label" for="">
                                        <i class="fas fa-trash-alt deletarAll" id="desconto"></i>
                                        </label>
                                        
                                    </div>
                                </th>
                                <th scope="col">Desconto</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Validade</th>                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dados">
                        
                            @if(count($descontos)>0)                            
                                @foreach($descontos as $desconto)                                   
                                    <tr>
                                        <td scope="row">
                                            <div class="form-check">
                                                
                                                <input class="form-check-input" type="checkbox" name="delete[]" value="{{$desconto->id}}" >
                                                
                                            </div>
                                        </td>
                                        <td>{{$desconto->nome}}</td>
                                        <td>R$ {{number_format($desconto->valor, 2, ',', ' ')}}</td>
                                        <td>{{$desconto->validade}}</td>
                                        <td>
                                            <a class="btn btn-outline-primary" href="{{route('descontos.show', $desconto->id)}}" role="button">Visualizar</a>
                                            
                                            <a class="btn btn-outline-danger deletar" data-deletar="{{$desconto->id}}" role="button">Deletar</a>
                                            
                                        </td>
                                    </tr>                                
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" style="text-align:center;">
                                        Não há pedidos cadastrados
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @isset($descontos)
                        {{ $descontos->links() }}
                    @endisset
                    <form action="{{route('descontos.delete')}}" method="post" id="form-deletar">
                        @csrf
                        <input type="hidden" name="id">
                    </form>
                    
                </div>                
            </div>
        </div>
    </div>
@endsection