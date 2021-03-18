@extends('principal')

@section('conteudo')

<form action="{{route('deletar.pedidos.selecionados')}}" method="post">
    {{csrf_field()}}
    <button type="submit" class="btn btn-info">Deletar Selecionados</button>
    <br>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Check</th>
                <th scope="col">@sortablelink('id','Id')</th>
                <th scope="col">@sortablelink('cliente_id','Usuário')</th>
                <th scope="col">@sortablelink('data_pedido','Data do Pedido')</th>
                <th scope="col">@sortablelink('quantidade_itens','Quantidade de Itens')</th>
                <th scope="col">Valor Total</th>
                <th scope="col">@sortablelink('status','Status')</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <th>
                    <input type="checkbox" value="{{$pedido->id}}" name="deletar[]">
</form>
</th>

<th scope="row">{{$pedido->id}}</th>

<!-- Modal Info Cliente -->

<style>
    .modal-backdrop {
        /* bug fix - no overlay */
        display: none;

    }
</style>

<div class="modal fade" id="modalInfoCliente{{$pedido->cliente_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"><b>Informações do Cliente</b></h3>
            </div>
            <div class="modal-body">

                <span>Nome do Cliente: {{$pedido->cliente->nome_cliente}}</span>
                <br>
                <span>CPF: {{$pedido->cliente->cpf}}</span>
                <br>
                <span>E-Mail: {{$pedido->cliente->email}}</span>


            </div>
        </div>
    </div>
</div>

<!-- Fim da Modal Info Cliente -->






<th scope="row">
    <a href="#" data-toggle="modal" data-target="#modalInfoCliente{{$pedido->cliente_id}}">
        {{$pedido->cliente->nome_cliente}}
    </a>
</th>

<td>{{date('d/m/Y', strtotime($pedido->data_pedido))}}</td>

<td>{{$pedido->quantidade_itens}}</td>

<td>{{number_format($pedido->produto->sum('valor_unitario'),2)}}</td>

<td>@if($pedido->status == 1) <button type="button" class="btn btn-warning">Em Aberto</button>
    @elseif($pedido->status == 2) <button type="button" class="btn btn-success">Pago</button>
    @else <button type="button" class="btn btn-danger">Cancelado</button>@endif

</td>

<td>
    <a href="{{route('editar.pedido', $pedido->id)}}" class="btn btn-warning">Editar</a>

    <form style="display: inline-block" method="post" action="{{route('delete.pedido', $pedido->id)}}" onsubmit="return confirm('Confirmar Exclusão do Pedido?')">
        {{method_field('delete')}}
        {{csrf_field()}}
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>

    <!-- Modal Status do Pedido -->

    <style>
        .modal-backdrop {
            /* bug fix - no overlay */
            display: none;

        }
    </style>

    <div class="modal fade" id="modalStatusPedido{{$pedido->status}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel"><b>Status do Pedido</b></h3>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('alterar.status.pedido', $pedido->id)}}">

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" name="status">Em Aberto</option>
                                <option value="2" name="status">Pago</option>
                                <option value="3" name="status">Cancelado</option>

                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Atualizar Status</button>


                    </form>


                </div>
            </div>
        </div>
    </div>

    <!-- Fim da Modal Info Cliente -->

    <a href="#" data-toggle="modal" class="btn btn-primary" data-target="#modalStatusPedido{{$pedido->status}}">Alterar Status</a>


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

<div> {{$pedidos->appends(request()->except('page'))->render()}}
</div>

<br>
<a href="{{route('cadastro.pedido')}}" class="btn btn-dark">Novo Pedido de Compra</a>



@endsection