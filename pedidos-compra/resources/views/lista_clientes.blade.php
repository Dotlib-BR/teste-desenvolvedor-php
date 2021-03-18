@extends('principal')

@section('conteudo')

<form action="{{route('deletar.clientes.selecionados')}}" method="post">
    {{csrf_field()}}
    <button type="submit" class="btn btn-info">Deletar Selecionados</button>

    <br>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Check</th>
                <th scope="col">@sortablelink('id','Id')</th>
                <th scope="col">@sortablelink('nome_cliente','Nome do Cliente')</th>
                <th scope="col">@sortablelink('cpf','CPF')</th>
                <th scope="col">@sortablelink('email','E-Mail')</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)

            <tr>

                <th>
                    <input type="checkbox" value="{{$cliente->id}}" name="deletar[]">
</form>
</th>
<th scope="row">{{$cliente->id}}</th>
<td>{{$cliente->nome_cliente}}</td>
<td>{{$cliente->cpf}}</td>
<td>{{$cliente->email}}</td>
<td>
    <a href="{{route('editar.cliente', $cliente->id)}}" class="btn btn-warning">Editar</a>

    <form style="display: inline-block" method="post" action="{{route('delete.cliente', $cliente->id)}}" onsubmit="return confirm('Confirmar Exclusão do Cliente?')">
        {{method_field('delete')}}
        {{csrf_field()}}
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>


</td>


</tr>
@endforeach


</tbody>

</table>

<form action="{{route('lista.clientes.paginate')}}" method="get">

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

<div> {{$clientes->appends(request()->except('page'))->render()}}
</div>

<br>

<a href="{{route('cadastro.cliente')}}" class="btn btn-dark">Novo Cliente</a>

<br>
<br>




@endsection