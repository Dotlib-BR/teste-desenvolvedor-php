@extends('layouts.controle')

@section('content')
<div class="card mb-4">
    <div class="card-header">
      Pedidos
    </div>
    <div class="card-body">
        {!! Form::model(request()->all(), ['route' => null, 'method' => 'GET']) !!}

        <div class="form-group">
            <label for="q">Nome, E-mail ou CPF</label>
            {!! Form::text('q',  null, ['class' => 'form-control', 'maxlength' => 255]) !!}
        </div>
        <div class="form-group">
            <label for="status_pedido_id">Status do pedido</label>
            {!! Form::select('status_pedido_id', ['' => 'Selecione'] + $status, null, ['class' => 'form-control']) !!}
        </div>

        <button type="submit" class="btn btn-info">Buscar</button>

        {!! Form::close() !!}
    </div>
</div>

<div class="card">
    <div class="card-header">
      Pedidos
      <div class="float-right">
        {{-- @include('controle.includes.pag') --}}
        <a href="{{ route('controle.pedidos.create') }}" class="btn btn-success">Novo Pedido</a>
      </div>
    </div>
    <div class="card-body table-responsive">
      <table class="table">
          <thead>
            <tr>
                <th>#Nº Pedido</th>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Subtotal</th>
                <th>Desconto</th>
                <th>Total</th>
                <th>Status</th>
                <th>Data do pedido</th>
                <th>Opções</th>
            </tr>
          </thead>
          <tbody>
              @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->numero_pedido }}</td>
                    <td>{{ $pedido->cliente->nome ?? '' }}</td>
                    <td>{{ $pedido->cliente->email ?? '' }}</td>
                    <td>{{ decimalParaPagina($pedido->valor_pedido ?? null) }}</td>
                    <td>{{ decimalParaPagina($pedido->valor_desconto ?? null) }}</td>
                    <td>{{ decimalParaPagina($pedido->valor_total ?? null) }}</td>
                    <td>
                        <label class="badge badge-{{ statusPedidoColor($pedido->status_pedido_id) }}">{{ $pedido->statusPedido->nome ?? '' }}</label>
                    </td>
                    <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('controle.pedidos.destroy', $pedido->id) }}" method="POST">
                            <a href="{{ route('controle.pedidos.show', $pedido->id) }}" class="btn btn-primary">Visualizar</a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger atencao">Excluir</button>
                        </form>
                    </td>
                </tr>
              @empty
                  <tr>
                      <td colspan="7">Nenhum registro cadastrado.</td>
                  </tr>
              @endforelse
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="7">{!! $pedidos->appends(request()->all())->links() !!}</td>
              </tr>
          </tfoot>
      </table>
    </div>
</div>
@endsection
