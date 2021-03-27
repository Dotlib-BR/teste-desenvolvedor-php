@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Pedidos / {{ (isset($pedido->id)) ? 'Detalhes' : 'Cadastrar' }}
    </div>
    <div class="card-body">
        @if(isset($pedido->id))
            {!! Form::model($pedido ?? null, ['route' => ['controle.pedidos.update', $pedido->id]]) !!}
            @method('put')
        @else
            @method('post')
            {!! Form::model($pedido ?? null, ['route' => 'controle.pedidos.store']) !!}
        @endif
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Cliente:</strong></td>
                        <td>{{ $pedido->cliente->nome }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail:</strong></td>
                        <td>{{ $pedido->cliente->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>CPF:</strong></td>
                        <td>{{ $pedido->cliente->cpf }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <h3>Produtos</h3>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Quant.</th>
                                        <th>Valor Uni.</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($pedido->pedidoProdutos as $produto)
                                    <tr>
                                        <td width="70%">{{ $produto->produto->nome }}</td>
                                        <td>{{ $produto->quantidade }}</td>
                                        <td>{{ decimalParaPagina($produto->valor_unitario) }}</td>
                                        <td>{{ decimalParaPagina($produto->subtotal) }}</td>
                                    </tr>
                                    @empty
                                @endforelse
                                </tbody>
                            </table>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td>Subtotal</td>
                        <td class="text-right">{{ decimalParaPagina($pedido->valor_pedido, 'R$') }}</td>
                    </tr>
                    <tr>
                        <td>
                            Desconto
                            {{ (isset($pedido->cupomDesconto->codigo)) ? '(CUPOM: ' . $pedido->cupomDesconto->codigo . ')' : '' }}
                        </td>
                        <td class="text-right">-{{ decimalParaPagina($pedido->valor_desconto ?? null) }}</td>
                    </tr>
                    <tr class="bg-info">
                        <td>Total</td>
                        <td class="text-right">{{ decimalParaPagina($pedido->valor_total, 'R$') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Status do pedido</label>
                            {!! Form::select('status_pedido_id', ['' => 'Selecione']+$status, null, ['class' => 'form-control']) !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('controle.pedidos.index') }}" class="btn btn-default float-right">Calcelar</a>
        {!! Form::close() !!}
    </div>
  </div>


@endsection
