@extends('principal')

@section('conteudo')

<form action="{{route('deletar.produtos.selecionados')}}" method="post">
    {{csrf_field()}}
    <button type="submit" class="btn btn-info">Deletar Selecionados</button>

    <br>
<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Check</th>
            <th scope="col">@sortablelink('id','Id')</th>
            <th scope="col">@sortablelink('codigo_barras','Código de Barras')</th>
            <th scope="col">@sortablelink('nome_produto','Nome do Produto')</th>
            <th scope="col">@sortablelink('valor_unitario','Valor Unitário')</th>
            <th scope="col">Ações</th>

        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)




        <tr>
        <th>
                    <input type="checkbox" value="{{$produto->id}}" name="deletar[]">
                    </form>
                    </th>
            <th scope="row">{{$produto->id}}</th>
            <td>{{$produto->codigo_barras}}</td>
            <td>{{$produto->nome_produto}}</td>
            <td>R$ {{number_format($produto->valor_unitario,2)}}</td>
            <td>
                <a href="{{route('editar.produto', $produto->id)}}" class="btn btn-warning" ">Editar</a>

                <form style=" display: inline-block" method="post" action="{{route('delete.produto', $produto->id)}}" onsubmit="return confirm('Confirmar Exclusão do Produto?')">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<form action="{{route('lista.produtos.paginate')}}" method="get">

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <input type="number" class="form-control" placeholder="Número de Itens por Página" name="itens_por_pagina">
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <button type="submit" class="btn btn-success">Filtrar</button>
            </div>
        </div>

    </div>


</form>

<br>
<br>

<div> {{$produtos->appends(request()->except('page'))->render()}}
</div>

<br>
<a href="{{route('cadastro.produto')}}" class="btn btn-dark">Novo Produto</a>


@endsection